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
#include <cairo/cairo-pdf.h>
#include <glib/gmem.h>
#include <glib/gstrfuncs.h>
#include "geral.h"


char *program;


void
usage ()
{
    printf ("Usage: %s [sql]\n", program);
    exit (1);
}


int
main (int argc, char **argv)
{
    char *CodUsuario;
    char *sql;
    
    program = argv [0];
    TamanhoFonte = 8.0; // padrao
    LarguraPagina = WIDTH_POINTS;
    AlturaPagina = HEIGHT_POINTS;
    
    program = argv [0];
    
    if (argc != 2) usage ();
    
    sql = argv [1];
    
    if ((CodUsuario = getenv ("XMONEY_UID")) == NULL)
    {
	printf ("$XMONEY_UID not set!\n");
	exit (1);
    }
    printf ("XMONEY_UID = %s\n", CodUsuario);
    
    char *filename = g_strdup_printf ("/var/spool/xmoney/%s.pdf", CodUsuario);
    cairo_surface_t *surface = cairo_pdf_surface_create (filename, LarguraPagina, AlturaPagina);
    cairo_t *cr = cairo_create (surface);
    
    impressao_geral (cr, sql);
    cairo_surface_destroy (surface);
    cairo_destroy (cr);
    g_free (filename);
    
    return 0;
}
