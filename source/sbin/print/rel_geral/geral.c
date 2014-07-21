/*
 * X-Money - Gestao Empresarial Integrada
 *
 * Copyright (C) 2010 Eneias Ramos de Melo <neneias@gmail.com>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */


#include <stdio.h>
#include <stdlib.h>
#include <glib/glist.h>
#include <glib/gstrfuncs.h>
#include "geral.h"


#define MARGEM_ESQUERDA 20.0
#define MARGEM_SUPERIOR 20.0


extern char *program;


double TamanhoFonte;
double LarguraPagina;
double AlturaPagina;


/*
 * gera relatorio ...
 *
 * ret: -1 =>  algum erro encontrado ...
 * ret:  0  => ok!
 */
int
impressao_geral (cairo_t *cr, char *sql)
{
    FILE *fp;
    char *sheader;
    char *sbuffer;
    char *cstr;
    long int len = 1; /* + */
    char car;
    GList *columns;
    double x = MARGEM_ESQUERDA, y = MARGEM_SUPERIOR;
    cairo_text_extents_t extents;
    const char *utf8 = "+";
    /* Controle de impressao de pagina */
    static long int actual_page = 0;
    static double start_field = 0.0;
    static double end_field = 0.0;
    double redundancy = 0.7;
    
    printf ("impressao_geral\n");
    
    /*
     * Listagem
     */
    char *command = g_strdup_printf ("/usr/share/xmoney/sh/print %s", sql);
    
    fp = popen (command, "r");
    
    g_free (command);
    
    if ((car = fgetc (fp)) != '+')
    {
	cairo_set_source_rgb (cr, 250, 250, 250);
	cairo_paint (cr);
        cairo_set_source_rgb (cr, 0, 0, 0);
	cairo_select_font_face (cr, "Monospace", CAIRO_FONT_SLANT_NORMAL, CAIRO_FONT_WEIGHT_NORMAL);
	cairo_set_font_size (cr, 20.0);
	cairo_move_to (cr, 20.0, 40.0);
	cairo_show_text (cr, "Ops! Sem dados disponiveis para listagem aqui!");
	
	return -1;
    }
    
    /*
     * Prop. fonte
     */
    cairo_set_source_rgb (cr, 0, 0, 0);
    cairo_select_font_face (cr, "Monospace", CAIRO_FONT_SLANT_NORMAL, CAIRO_FONT_WEIGHT_NORMAL);
    cairo_set_font_size (cr, TamanhoFonte);
    cairo_text_extents (cr, utf8, &extents);
    
    /*
     * Cabecalho
     */
    columns = NULL; // g_list_alloc ();
    
    /* ---+ */
    while ((car = getc (fp)) != '\n')
    {
	++ len;
	
	if (car == '+')
	{
	    columns = g_list_append (columns, g_strdup_printf ("%ld", len));
	    
	    if ((extents.width * len) > LarguraPagina)
	    {
		++ actual_page;
	    }
	    else
	    {
		end_field = len;
	    }
	}
	
	printf ("%c", car);
    }
    
    printf ("\n");
    
    printf ("Largura Pagina: %f\n"
            "Largura Campos: %f\n",
            LarguraPagina, extents.width * len);
    
    GList *list = g_list_first (columns);
    printf ("list->length = %d\n", g_list_length (list));
    while (list)
    {
	printf ("coluna : %d\n", atoi ((char *) list->data));
	
	list = list->next;
    }
    
    printf ("string width :    %f\n"
            "       height:    %f\n"
	    "       x_bearing: %f\n"
	    "       y_bearing: %f\n"
	    "       x_advance: %f\n"
	    "       y_advance: %f\n",
	    extents.width,     extents.height,
	    extents.x_bearing, extents.y_bearing,
	    extents.x_advance, extents.y_advance);
    
    /*
     * Fundo branco pagina
     */
    cairo_set_source_rgb (cr, 255, 255, 255);
    cairo_rectangle (cr, 0.0, 0.0, LarguraPagina, AlturaPagina);
    cairo_fill (cr);
    
    /*
     * Fundo verde cabelho
     */
    cairo_set_source_rgb (cr, 0, 100, 0);
    cairo_rectangle (cr, x, y, (extents.width + redundancy) * len, extents.height * 3);
    cairo_fill (cr);
    
    // linha topo ...
    cairo_set_source_rgb (cr, 0, 0, 0); // preto
    cairo_move_to (cr, x, y);
    cairo_line_to (cr, x + ((extents.width + redundancy) * len), y);
    cairo_stroke (cr);
    
    // cabecalho sql
    sheader = (char *) malloc (len);
    sbuffer = (char *) malloc (len);
    
    fread (sheader, len, 1, fp);
    cstr = strndup (sbuffer, len);
    
    while ((car = getc (fp)) != '\n');
    
    y += extents.height * 2;
    cairo_move_to (cr, x, y);
    cairo_show_text (cr, cstr = strndup (sheader, len));
    free (cstr);
    
    /* +---+ */
    while ((car = getc (fp)) != '\n');
    
    // linha debaixo do cabecalho ...
    y += extents.height;
    cairo_move_to (cr, x, y);
    cairo_line_to (cr, x + ((extents.width + redundancy) * len), y);
    cairo_stroke (cr);
    
    /*
     * Linhas
     */
    char n_linhas = 0;
    int bottom_y;
    y += extents.height * 2;
    while (fread (sbuffer, len, 1, fp))
    {
	cstr = strndup (sbuffer, len);
	
	if (cstr [0] == '+')
	{
	    cairo_move_to (cr, x, bottom_y);
	    cairo_line_to (cr, x + ((extents.width + redundancy) * len), bottom_y);
	    cairo_stroke (cr);
	    free (cstr);
	    break;
	}
	
	// Listagem
   	cairo_move_to (cr, x, y);
	cairo_show_text (cr, cstr);
	free (cstr);
	
	bottom_y = y + extents.height;
	
	//cairo_move_to (cr, x, y - 10.0);
	//cairo_line_to (cr, WIDTH_POINTS, y - 10.0);
	//cairo_stroke (cr);
	
	
	/* Espera nova linha ... */
	while ((car = getc (fp)) != '\n');
	
	++ n_linhas;
	if (n_linhas > 40)
	{
	    // linha debaixo da listatem
	    y += extents.height;
	    cairo_move_to (cr, x, y);
	    cairo_line_to (cr, x + ((extents.width + redundancy) * len), y);
	    cairo_stroke (cr);
	    cairo_show_page (cr);
	    
	    y = MARGEM_ESQUERDA;
	    x = MARGEM_SUPERIOR;
	    n_linhas = 0;
	    
	    // linha topo da listagem
	    cairo_move_to (cr, x, y);
	    cairo_line_to (cr, x + ((extents.width + redundancy) * len), y);
	    cairo_stroke (cr);
	}
	
	y += extents.height * 2;
    }
    
    free (sheader);
    free (sbuffer);
    g_list_free (columns);
    fclose (fp);
    
    return 0;
}
