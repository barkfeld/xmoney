#
# X-Money - Gestao Empresarial Integrada
#
# Copyright (C) 2010 Eneias Ramos de Melo <neneias@gmail.com>
#
# This library is free software; you can redistribute it and/or
# modify it under the terms of the GNU Lesser General Public
# License as published by the Free Software Foundation; either
# version 2.1 of the License, or (at your option) any later version.
# 
# This library is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
# Lesser General Public License for more details.
# 
# You should have received a copy of the GNU Lesser General Public
# License along with this library; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#

GLIB_CFLAGS = `pkg-config --cflags glib-2.0`
GLIB_CLIBS = `pkg-config --libs glib-2.0`

CAIRO_CFLAGS = `pkg-config --cflags cairo-pdf`
CAIRO_CLIBS = `pkg-config --libs cairo-pdf`

COMPILE = gcc -m32 $(GLIB_CFLAGS) $(CAIRO_CFLAGS)
LINK = gcc -m32 $(GLIB_CLIBS) $(CAIRO_CLIBS)

SOURCES = geral.c main.c
OBJECTS = $(SOURCES:.c=.o)

all: $(OBJECTS)
	$(LINK) $(OBJECTS)

.c.o: $(SOURCES)
	$(COMPILE) -c $<

clean:
	@rm -rfv *.o a.out
