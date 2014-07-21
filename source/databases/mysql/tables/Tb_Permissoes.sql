SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Permissoes table : 
#

DROP TABLE IF EXISTS Tb_Permissoes;

CREATE TABLE Tb_Permissoes (
  Cod_S_Permissao INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_Perfil INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Item INTEGER(11) UNSIGNED NOT NULL,
  PRIMARY KEY (Cod_S_Permissao),
  UNIQUE KEY Cod_S_Permissao (Cod_S_Permissao),
  KEY Cod_S_Usuario (Cod_S_Perfil),
  KEY Cod_S_Subitem (Cod_S_Item),
  CONSTRAINT Tb_Permissoes_Item FOREIGN KEY (Cod_S_Item) REFERENCES Tb_Itens (Cod_S_Item),
  CONSTRAINT Tb_Permissoes_Perfil FOREIGN KEY (Cod_S_Perfil) REFERENCES Tb_Perfis (Cod_S_Perfil)
)ENGINE=InnoDB
AUTO_INCREMENT=125 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Permissoes table
#

INSERT INTO Tb_Permissoes (Cod_S_Permissao, Cod_S_Perfil, Cod_S_Item) VALUES 
  (1,1,1),
  (2,1,2),
  (3,1,3),
  (4,1,4),
  (5,1,5),
  (6,1,6),
  (7,1,7),
  (8,1,8),
  (9,1,9),
  (10,1,10),
  (11,1,11),
  (12,1,12),
  (13,1,13),
  (14,1,14),
  (15,1,15),
  (16,1,16),
  (17,1,17),
  (18,1,18),
  (19,1,19),
  (20,1,20),
  (21,1,21),
  (22,1,22),
  (23,1,23),
  (24,1,24),
  (25,1,25),
  (26,1,26),
  (27,1,27),
  (28,1,28),
  (29,1,29),
  (30,1,30),
  (31,1,31),
  (32,1,32),
  (33,1,33),
  (34,1,34),
  (35,1,35),
  (36,1,36),
  (37,1,37),
  (38,1,38),
  (39,1,39),
  (40,1,40),
  (41,1,41),
  (42,1,42),
  (43,1,43),
  (44,1,44),
  (45,1,45),
  (46,1,46),
  (47,1,47),
  (48,1,48),
  (49,1,49),
  (50,1,50),
  (51,1,51),
  (52,1,52),
  (53,1,53),
  (54,1,54),
  (55,1,55),
  (56,1,56),
  (57,1,57),
  (58,1,58),
  (59,1,59),
  (60,1,60),
  (61,1,61),
  (62,1,62),
  (63,1,63),
  (64,1,64),
  (65,1,65),
  (66,1,66),
  (67,1,67),
  (68,1,68),
  (69,1,69),
  (70,1,70),
  (71,1,71),
  (72,1,72),
  (73,1,73),
  (74,1,74),
  (75,1,75),
  (76,1,76),
  (77,1,77),
  (78,1,78),
  (79,1,79),
  (80,1,80),
  (81,1,81),
  (82,1,82),
  (83,1,83),
  (84,1,84),
  (85,1,85),
  (86,1,86),
  (87,1,87),
  (88,1,88),
  (89,1,89),
  (90,1,90),
  (91,1,91),
  (92,1,92),
  (93,1,93),
  (94,1,94),
  (95,1,95),
  (96,1,96),
  (97,1,97),
  (98,1,98),
  (99,1,99),
  (100,1,100),
  (101,1,101),
  (102,1,102),
  (103,1,103),
  (104,1,104),
  (105,1,105),
  (106,1,106),
  (107,1,107),
  (108,1,108),
  (109,1,109),
  (110,1,110),
  (111,1,111),
  (112,1,112),
  (113,1,113),
  (114,1,114),
  (115,1,115),
  (116,1,116),
  (117,1,117),
  (118,1,118),
  (119,1,119),
  (120,1,120),
  (121,1,121),
  (122,1,122),
  (123,1,123),
  (124,1,124);

COMMIT;
