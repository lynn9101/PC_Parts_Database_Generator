CREATE TABLE Motherboard1
(formfactor CHAR(50) NOT NULL,
supportedmemorysize INT NOT NULL,
PRIMARY KEY (formfactor, supportedmemorysize) );

CREATE TABLE Motherboard2
(id INT NOT NULL,
chipset CHAR(100) NOT NULL,
formfactor CHAR(50) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (formfactor) REFERENCES Motherboard1(formfactor) );

CREATE TABLE Motherboard3
(id INT NOT NULL,
memoryslots INT NOT NULL,
PRIMARY KEY (id, memoryslots),
FOREIGN KEY (id) REFERENCES Motherboard2(id) 
    ON DELETE CASCADE
    ON UPDATE CASCADE );

CREATE TABLE Cpu
(partid INT NOT NULL,
coreclock DOUBLE NOT NULL,
coresnumber INT NOT NULL,
brandname CHAR(100) NOT NULL,
PRIMARY KEY (partid) );

CREATE TABLE Memory1
(partid INT NOT NULL,
formfactor CHAR(50) NOT NULL,
PRIMARY KEY (partid) );

CREATE TABLE Memory2
(partid INT NOT NULL,
modelname CHAR(100) NOT NULL,
sizeGB INT NOT NULL,
speed CHAR(20) NOT NULL,
PRIMARY KEY (partid, sizeGB, speed),
FOREIGN KEY (partid) REFERENCES Memory1(partid) 
    ON DELETE CASCADE
    ON UPDATE CASCADE );

CREATE TABLE SSDStorage1
(model CHAR(100) NOT NULL,
writespeedMBps INT NOT NULL,
readspeedMBps INT NOT NULL,
PRIMARY KEY (model) );

CREATE TABLE SSDStorage2
(storagesizeGB INT NOT NULL,
model CHAR(100) NOT NULL,
formfactor CHAR(30) NOT NULL,
PRIMARY KEY (storagesizeGB, model, formfactor),
FOREIGN KEY (model) REFERENCES SSDStorage1(model) 
    ON DELETE CASCADE
    ON UPDATE CASCADE );

CREATE TABLE HDDStorage1
(writespeedMBps INT NOT NULL,
readspeedMBps INT NOT NULL,
rpm INT NOT NULL,
PRIMARY KEY (writespeedMBps, readspeedMBps) );

CREATE TABLE HDDStorage2
(model CHAR(100) NOT NULL,
writespeedMBps INT NOT NULL,
readspeedMBps INT NOT NULL,
PRIMARY KEY (model), 
FOREIGN KEY (writespeedMBps, readspeedMBps) REFERENCES HDDStorage1(writespeedMBps, readspeedMBps) 
    ON UPDATE CASCADE );

CREATE TABLE HDDStorage3
(storagesizeGB INT NOT NULL,
model CHAR(100) NOT NULL,
PRIMARY KEY (storagesizeGB, model),
FOREIGN KEY (model) REFERENCES HDDStorage2(model)
    ON UPDATE CASCADE );

CREATE TABLE GPU_Contains1
(gpuid INT NOT NULL,
model CHAR(50) NOT NULL,
memorytype CHAR(10) NOT NULL,
boostclock INT NOT NULL,
coreclock INT NOT NULL,
PRIMARY KEY (gpuid, model) );

CREATE TABLE GPU_Contains2
(integrated BOOLEAN NOT NULL,
cpuid INT NOT NULL,
PRIMARY KEY (cpuid),
FOREIGN KEY (cpuid) REFERENCES Cpu(partid) );

CREATE TABLE GPU_Contains3
(gpuid INT NOT NULL,
model CHAR(50) NOT NULL,
memorysizeGB INT NOT NULL, 
cpuid INT NOT NULL,
PRIMARY KEY (gpuid, model, memorysizeGB, cpuid),
FOREIGN KEY (gpuid, model) REFERENCES GPU_Contains1(gpuid, model)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
FOREIGN KEY (cpuid) REFERENCES Cpu(partid) );

CREATE TABLE CoolingSystem1
(modelname CHAR(100) NOT NULL,
noiseleveldB INT NOT NULL,
PRIMARY KEY (modelname) );

CREATE TABLE CoolingSystem2
(modelname CHAR(100) NOT NULL,
colour CHAR(20) NOT NULL,
PRIMARY KEY (modelname, colour),
FOREIGN KEY (modelname) REFERENCES CoolingSystem1(modelname) 
   ON UPDATE CASCADE );

CREATE TABLE Case1
(modelname CHAR(100) NOT NULL,
formfactor CHAR(20) NOT NULL,
PRIMARY KEY (modelname) );

CREATE TABLE Case2
(modelname CHAR(100) NOT NULL,
colour CHAR(20) NOT NULL,
PRIMARY KEY (modelname, colour),
FOREIGN KEY (modelname) REFERENCES Case1(modelname)
    ON UPDATE CASCADE );

CREATE TABLE PowerSupply1
(modelname CHAR(50) NOT NULL,
watts INT NOT NULL,
modularity CHAR(10) NOT NULL,
PRIMARY KEY (modelname) );

CREATE TABLE PowerSupply2
(modelname CHAR(50) NOT NULL,
colour CHAR(20) NOT NULL,
PRIMARY KEY (modelname, colour),
FOREIGN KEY (modelname) REFERENCES PowerSupply1(modelname)
    ON DELETE CASCADE
    ON UPDATE CASCADE );

CREATE TABLE User1
(userid INT NOT NULL,
name CHAR(50) NOT NULL,
PRIMARY KEY (userid) );

CREATE TABLE User2
(userid INT NOT NULL,
address CHAR(100) NOT NULL,
phonenumber BIGINT NOT NULL,
PRIMARY KEY (userid, address, phonenumber),
FOREIGN KEY (userid) REFERENCES User1(userid) );

CREATE TABLE OrderPCPart_Orders
(userid INT NOT NULL,
orderid INT NOT NULL,
PRIMARY KEY (userid, orderid),
FOREIGN KEY (userid) REFERENCES User1(userid) );

CREATE TABLE manufacturer_supplies
(id INT NOT NULL AUTO_INCREMENT,
 name CHAR(20) NOT NULL,
 contactinfo CHAR(50) NOT NULL,
 address CHAR(100) NOT NULL,
 password CHAR(100) NOT NULL,
 PRIMARY KEY (id));

CREATE TABLE categories (
id INT NOT NULL AUTO_INCREMENT,
title CHAR(20) NOT NULL,
PRIMARY KEY(id) );

INSERT INTO Motherboard1 VALUES ('AT', 512);
INSERT INTO Motherboard1 VALUES ('SSI CEB', 4096);
INSERT INTO Motherboard1 VALUES ('SSI EEB', 128);
INSERT INTO Motherboard1 VALUES ('Mini ITX', 4096);
INSERT INTO Motherboard1 VALUES ('Mini DTX', 4096);
INSERT INTO Motherboard1 VALUES ('Thin Mini ITX', 128);
INSERT INTO Motherboard1 VALUES ('HPTX', 2048);
INSERT INTO Motherboard1 VALUES ('Flex ATX', 64);
INSERT INTO Motherboard1 VALUES ('XL ATX', 4096);
INSERT INTO Motherboard1 VALUES ('ATX', 1024);

INSERT INTO Motherboard2 VALUES (712, 'Intel Q570', 'AT');
INSERT INTO Motherboard2 VALUES (878, 'Intel Z690', 'SSI CEB');
INSERT INTO Motherboard2 VALUES (949, 'Intel Z97', 'SSI EEB');
INSERT INTO Motherboard2 VALUES (388, 'Intel NM70', 'Mini ITX');
INSERT INTO Motherboard2 VALUES (735, 'Intel H270', 'Mini DTX');
INSERT INTO Motherboard2 VALUES (427, 'Intel Z270', 'Thin Mini ITX');
INSERT INTO Motherboard2 VALUES (758, 'AMD X570', 'HPTX');
INSERT INTO Motherboard2 VALUES (251, 'Intel 5520', 'Flex ATX');
INSERT INTO Motherboard2 VALUES (215, 'Intel Z490', 'XL ATX');
INSERT INTO Motherboard2 VALUES (829, 'AMD B550', 'ATX');

INSERT INTO Motherboard3 VALUES (712, 10);
INSERT INTO Motherboard3 VALUES (878, 8);
INSERT INTO Motherboard3 VALUES (949, 14);
INSERT INTO Motherboard3 VALUES (388, 16);
INSERT INTO Motherboard3 VALUES (735, 8);
INSERT INTO Motherboard3 VALUES (427, 14);
INSERT INTO Motherboard3 VALUES (758, 2);
INSERT INTO Motherboard3 VALUES (251, 4);
INSERT INTO Motherboard3 VALUES (215, 8);
INSERT INTO Motherboard3 VALUES (829, 16);

INSERT INTO Cpu VALUES (265, 2.6, 64, 'Intel Xeon E5 3100');
INSERT INTO Cpu VALUES (393, 3.0, 4, 'AMD Athlon X2 3900');
INSERT INTO Cpu VALUES (899, 4.4, 8, 'Intel Core i3 11700');
INSERT INTO Cpu VALUES (62, 3.2, 4, 'Intel Pentium Gold 12500');
INSERT INTO Cpu VALUES (595, 4.0, 4, 'AMD Athlon II X3 14000');
INSERT INTO Cpu VALUES (403, 1.5, 4, 'AMD Phenom II X3 12500');
INSERT INTO Cpu VALUES (170, 3.5, 2, 'AMD Opteron 6700');
INSERT INTO Cpu VALUES (106, 1.6, 2, 'AMD Phenom II X2 7500');
INSERT INTO Cpu VALUES (218, 2.4, 2, 'Intel Core 2 Duo 7300');
INSERT INTO Cpu VALUES (621, 2.1, 8, 'AMD Phenom II X3 12000');
INSERT INTO Cpu VALUES (437, 4.1, 64, 'Intel Pentium Gold 11300');

INSERT INTO Memory1 VALUES (534, '184-pin DIMM');
INSERT INTO Memory1 VALUES (298, '200-pin SODIMM');
INSERT INTO Memory1 VALUES (730, '260-pin SODIMM');
INSERT INTO Memory1 VALUES (467, '260-pin SODIMM');
INSERT INTO Memory1 VALUES (626, '184-pin DIMM');
INSERT INTO Memory1 VALUES (40, '204-pin SODIMM');
INSERT INTO Memory1 VALUES (404, '184-pin DIMM');
INSERT INTO Memory1 VALUES (772, '260-pin SODIMM');
INSERT INTO Memory1 VALUES (884, '184-pin DIMM');
INSERT INTO Memory1 VALUES (585, '260-pin SODIMM');

INSERT INTO Memory2 VALUES (534, 'Apotop T-Force Delta RGB 64 GB', 64, 'DDR3-4000');
INSERT INTO Memory2 VALUES (298, 'OCZ Vulcan Z 1 GB', 1, 'DDR2-160');
INSERT INTO Memory2 VALUES (730, 'Wintec T-Force Vulcan Z 4 G', 4, 'DDR4-4800');
INSERT INTO Memory2 VALUES (467, 'V-Color Aegis 16 GB', 16, 'DDR5-6000');
INSERT INTO Memory2 VALUES (626, 'G.Skill Trident Z Royal 1 GB', 1, 'DDR5-6800');
INSERT INTO Memory2 VALUES (40, 'Neo Forza Vengeance LPX 4 GB', 4, 'DDR4-4800');
INSERT INTO Memory2 VALUES (404, 'Mushkin Dominator Platinum 1 GB', 1, 'DDR5-6800');
INSERT INTO Memory2 VALUES (772, 'Lexar FURY Beast 16 GB', 16, 'DDR2-2400');
INSERT INTO Memory2 VALUES (884, 'Patriot Ripjaws V 8 GB', 8, 'DDR2-1600');
INSERT INTO Memory2 VALUES (585, 'Compustocx Trident Z5 RGB 8 GB', 32, 'DDR1-400');

INSERT INTO SSDStorage1 VALUES ('Eluktro 490 P1', 1137, 1217);
INSERT INTO SSDStorage1 VALUES ('Corsair 1050 MX', 1473, 1533);
INSERT INTO SSDStorage1 VALUES ('Verbatim 470 QVO', 2011, 2051);
INSERT INTO SSDStorage1 VALUES ('TCSunBow 870 P2', 1289, 1319);
INSERT INTO SSDStorage1 VALUES ('KIOXIA 520 Pro', 1842, 1892);
INSERT INTO SSDStorage1 VALUES ('Enmotus 1110 NV1', 678, 778);
INSERT INTO SSDStorage1 VALUES ('Plextor 620 MP', 1620, 1670);
INSERT INTO SSDStorage1 VALUES ('TCSunBow 680 P2', 329, 399);
INSERT INTO SSDStorage1 VALUES ('Corsair 660', 1242, 1262);
INSERT INTO SSDStorage1 VALUES ('Sony 880 P2', 784, 804);

INSERT INTO SSDStorage2 VALUES (8192, 'Eluktro 490 P1', 'M.2-22110');
INSERT INTO SSDStorage2 VALUES (64, 'Corsair 1050 MX', 'M.2-2260');
INSERT INTO SSDStorage2 VALUES (2048, 'Verbatim 470 QVO','M.2-2280');
INSERT INTO SSDStorage2 VALUES (64, 'TCSunBow 870 P2', 'PCIe');
INSERT INTO SSDStorage2 VALUES (32768, 'KIOXIA 520 Pro', 'PCIe');
INSERT INTO SSDStorage2 VALUES (16384, 'Enmotus 1110 NV1', '1.8"');
INSERT INTO SSDStorage2 VALUES (8192, 'Plextor 620 MP', 'M.2-2260');
INSERT INTO SSDStorage2 VALUES (128, 'TCSunBow 680 P2', 'M.2-2260');
INSERT INTO SSDStorage2 VALUES (128, 'Corsair 660', 'M.2-2280');
INSERT INTO SSDStorage2 VALUES (1024, 'Sony 880 P2', '1.8"');

INSERT INTO HDDStorage1 VALUES (134, 134, 5400);
INSERT INTO HDDStorage1 VALUES (227, 227, 14100);
INSERT INTO HDDStorage1 VALUES (135, 135, 11800);
INSERT INTO HDDStorage1 VALUES (249, 249, 4600);
INSERT INTO HDDStorage1 VALUES (207, 207, 2300);
INSERT INTO HDDStorage1 VALUES (191, 191, 1200);
INSERT INTO HDDStorage1 VALUES (74, 74, 10100);
INSERT INTO HDDStorage1 VALUES (156, 156, 13600);
INSERT INTO HDDStorage1 VALUES (238, 238, 1700);
INSERT INTO HDDStorage1 VALUES (175, 175, 5400);

INSERT INTO HDDStorage2 VALUES ('Biostar 960 Evo Plus', 134, 134);
INSERT INTO HDDStorage2 VALUES ('Mushkin 1080 NV1', 227, 227);
INSERT INTO HDDStorage2 VALUES ('OCZ 310 QX', 135, 135);
INSERT INTO HDDStorage2 VALUES ('OCZ 1020 Plus', 249, 249);
INSERT INTO HDDStorage2 VALUES ('Hyundai Technology 450 Pro', 207, 207);
INSERT INTO HDDStorage2 VALUES ('Zalman 750', 191, 191);
INSERT INTO HDDStorage2 VALUES ('PLDS 920 P1', 74, 74);
INSERT INTO HDDStorage2 VALUES ('Addlink 1070 MP', 156, 156);
INSERT INTO HDDStorage2 VALUES ('MSI 510 Pro', 238, 238);
INSERT INTO HDDStorage2 VALUES ('Corsair 630 NV1', 175, 175);

INSERT INTO HDDStorage3 VALUES (32, 'Biostar 960 Evo Plus');
INSERT INTO HDDStorage3 VALUES (32768, 'Mushkin 1080 NV1');
INSERT INTO HDDStorage3 VALUES (4096, 'OCZ 310 QX');
INSERT INTO HDDStorage3 VALUES (2048, 'OCZ 1020 Plus');
INSERT INTO HDDStorage3 VALUES (32768, 'Hyundai Technology 450 Pro');
INSERT INTO HDDStorage3 VALUES (32, 'Zalman 750');
INSERT INTO HDDStorage3 VALUES (512, 'PLDS 920 P1');
INSERT INTO HDDStorage3 VALUES (2048, 'Addlink 1070 MP');
INSERT INTO HDDStorage3 VALUES (16384, 'MSI 510 Pro');
INSERT INTO HDDStorage3 VALUES (32768, 'Corsair 630 NV1');

INSERT INTO GPU_Contains1 VALUES (690,'Radeon Pro 420', 'DDR', 1267,386);
INSERT INTO GPU_Contains1 VALUES (976, 'GeForce GT 440', 'DDR', 1746, 106);
INSERT INTO GPU_Contains1 VALUES (916, 'GeForce GT 660', 'DDR', 2529, 1077);
INSERT INTO GPU_Contains1 VALUES (966, 'Radeon Pro 350', 'DDR', 1717,251);
INSERT INTO GPU_Contains1 VALUES (627, 'GeForce GTX 480', 'DDR', 2251, 652);
INSERT INTO GPU_Contains1 VALUES (798, 'Radeon Pro 640', 'DDR', 2660, 1724);
INSERT INTO GPU_Contains1 VALUES (145, 'Quadro 830', 'GDDR', 1349, 1596);
INSERT INTO GPU_Contains1 VALUES (514, 'GeForce RTX 660', 'DDR', 1044, 2081);
INSERT INTO GPU_Contains1 VALUES (375, 'GeForce GT 650', 'DDR', 888, 2122);
INSERT INTO GPU_Contains1 VALUES (611, 'Radeon HD 350', 'DDR', 1243, 1997);

INSERT INTO GPU_Contains2 VALUES (true, 393);
INSERT INTO GPU_Contains2 VALUES (true, 899);
INSERT INTO GPU_Contains2 VALUES (false, 62);
INSERT INTO GPU_Contains2 VALUES (true, 595);
INSERT INTO GPU_Contains2 VALUES (false, 403);
INSERT INTO GPU_Contains2 VALUES (false, 170);
INSERT INTO GPU_Contains2 VALUES (true, 106);
INSERT INTO GPU_Contains2 VALUES (true, 218);
INSERT INTO GPU_Contains2 VALUES (true, 621);
INSERT INTO GPU_Contains2 VALUES (false, 437);

INSERT INTO GPU_Contains3 VALUES (690,'Radeon Pro 420', 12, 595);
INSERT INTO GPU_Contains3 VALUES (976, 'GeForce GT 440', 4, 403);
INSERT INTO GPU_Contains3 VALUES (916, 'GeForce GT 660', 12, 393);
INSERT INTO GPU_Contains3 VALUES (966, 'Radeon Pro 350', 16, 106);
INSERT INTO GPU_Contains3 VALUES (627, 'GeForce GTX 480', 4, 621);
INSERT INTO GPU_Contains3 VALUES (798, 'Radeon Pro 640', 4, 899);
INSERT INTO GPU_Contains3 VALUES (145, 'Quadro 830', 16, 437);
INSERT INTO GPU_Contains3 VALUES (514, 'GeForce RTX 660', 2, 62);
INSERT INTO GPU_Contains3 VALUES (375, 'GeForce GT 650', 2, 170);
INSERT INTO GPU_Contains3 VALUES (611, 'Radeon HD 350', 10, 218);

INSERT INTO CoolingSystem1 VALUES ('Rosewill Kraken X63 RGB', 33);
INSERT INTO CoolingSystem1 VALUES ('upHere Liquid Freezer II 360', 2);
INSERT INTO CoolingSystem1 VALUES ('Corsair Kraken Z63', 10);
INSERT INTO CoolingSystem1 VALUES ('Noctua NH-D15', 3);
INSERT INTO CoolingSystem1 VALUES ('GAMDIAS iCUE H170i ELITE LCD', 42);
INSERT INTO CoolingSystem1 VALUES ('Scythe Kraken X53', 40);
INSERT INTO CoolingSystem1 VALUES ('ZEROtherm iCUE H100i RGB PRO XT', 41);
INSERT INTO CoolingSystem1 VALUES ('Gigabyte iCUE H170i ELITE LCD', 49);
INSERT INTO CoolingSystem1 VALUES ('GameMax Kraken Z73 RGB', 33);
INSERT INTO CoolingSystem1 VALUES ('darkFlash H100x', 45);

INSERT INTO CoolingSystem2 VALUES ('Rosewill Kraken X63 RGB', 'Clear');
INSERT INTO CoolingSystem2 VALUES ('upHere Liquid Freezer II 360', 'Orange/Blue');
INSERT INTO CoolingSystem2 VALUES ('Corsair Kraken Z63', 'Orange');
INSERT INTO CoolingSystem2 VALUES ('Noctua NH-D15', 'White/Green');
INSERT INTO CoolingSystem2 VALUES ('GAMDIAS iCUE H170i ELITE LCD', 'Clear');
INSERT INTO CoolingSystem2 VALUES ('Scythe Kraken X53', 'Pink/White');
INSERT INTO CoolingSystem2 VALUES ('ZEROtherm iCUE H100i RGB PRO XT', 'Gold/Pink');
INSERT INTO CoolingSystem2 VALUES ('Gigabyte iCUE H170i ELITE LCD', 'Red/White');
INSERT INTO CoolingSystem2 VALUES ('GameMax Kraken Z73 RGB', 'Yellow');
INSERT INTO CoolingSystem2 VALUES ('darkFlash H100x', 'Orange/Black');

INSERT INTO Case1 VALUES ('Svive MasterBox NR400', 'AT');
INSERT INTO Case1 VALUES ('TUNIQ Carbide 175R', 'ATX');
INSERT INTO Case1 VALUES ('Genesis Matrexx 50', 'Mini DTX');
INSERT INTO Case1 VALUES ('XClio Versa H17', 'Mini ITX');
INSERT INTO Case1 VALUES ('LC-Power O11 Dynamic EVO', 'ATX');
INSERT INTO Case1 VALUES ('Aerocool Meshify C', 'HPTX');
INSERT INTO Case1 VALUES ('HG Computers O11 Dynamic EVO', 'XL ATX');
INSERT INTO Case1 VALUES ('NOX Pure Base 700DX', 'ATX');
INSERT INTO Case1 VALUES ('Empire Gaming MasterBox NR400', 'SSI EEB');
INSERT INTO Case1 VALUES ('Broadway Com Corp iCUE 6000X', 'SSI CEB');

INSERT INTO Case2 VALUES ('Svive MasterBox NR400', 'Clear/Silver');
INSERT INTO Case2 VALUES ('TUNIQ Carbide 175R', 'Orange');
INSERT INTO Case2 VALUES ('Genesis Matrexx 50', 'White/Silver');
INSERT INTO Case2 VALUES ('XClio Versa H17', 'Blue');
INSERT INTO Case2 VALUES ('LC-Power O11 Dynamic EVO', 'Black');
INSERT INTO Case2 VALUES ('Aerocool Meshify C', 'Silver/Blue');
INSERT INTO Case2 VALUES ('HG Computers O11 Dynamic EVO', 'Gold');
INSERT INTO Case2 VALUES ('NOX Pure Base 700DX', 'Silver');
INSERT INTO Case2 VALUES ('Empire Gaming MasterBox NR400', 'Camo/White');
INSERT INTO Case2 VALUES ('Broadway Com Corp iCUE 6000X', 'Beige');

INSERT INTO PowerSupply1 VALUES ('Kingwin Focus GX', 1560, 'Semi');
INSERT INTO PowerSupply1 VALUES ('BFG HX Platinum', 190, 'Semi');
INSERT INTO PowerSupply1 VALUES ('Xilence RMx 2018', 1280, 'Full');
INSERT INTO PowerSupply1 VALUES ('MSI Dark Power Pro 12', 680, 'Full');
INSERT INTO PowerSupply1 VALUES ('NOX V SFX Gold', 530, 'No');
INSERT INTO PowerSupply1 VALUES ('Kingwin RMx 2021', 1830, 'Full');
INSERT INTO PowerSupply1 VALUES ('Segotep C 2020', 440, 'Semi');
INSERT INTO PowerSupply1 VALUES ('MSI C 2020', 2000, 'Full');
INSERT INTO PowerSupply1 VALUES ('Apevia W1', 1240, 'No');
INSERT INTO PowerSupply1 VALUES ('Enermax P GM', 1540, 'No');

INSERT INTO PowerSupply2 VALUES ('Kingwin Focus GX', 'Camo/Purple');
INSERT INTO PowerSupply2 VALUES ('BFG HX Platinum', 'Yellow/Pink');
INSERT INTO PowerSupply2 VALUES ('Xilence RMx 2018', 'Orange/Pink');
INSERT INTO PowerSupply2 VALUES ('MSI Dark Power Pro 12', 'Orange/Clear');
INSERT INTO PowerSupply2 VALUES ('NOX V SFX Gold', 'Blue');
INSERT INTO PowerSupply2 VALUES ('Kingwin RMx 2021', 'Camo/Grey');
INSERT INTO PowerSupply2 VALUES ('Segotep C 2020', 'Black');
INSERT INTO PowerSupply2 VALUES ('MSI C 2020', 'Camo/Green');
INSERT INTO PowerSupply2 VALUES ('Apevia W1', 'Silver/White');
INSERT INTO PowerSupply2 VALUES ('Enermax P GM', 'Blue');

INSERT INTO Manufacturer_Supplies VALUES (913, 'Super Flower', 'SuperFlower@hotmail.com', 'Oscar Road', 'test');
INSERT INTO Manufacturer_Supplies VALUES (192, 'iBuypower', 'iBuypower@gmail.com', 'Giovanni Alley', 'test');
INSERT INTO Manufacturer_Supplies VALUES (92, 'CoolMax', 'CoolMax@yahoo.com', 'King Street', 'test');
INSERT INTO Manufacturer_Supplies VALUES (1000, 'Scythe', 'Scythe@outlook.com', 'Harrison Avenue', 'test');
INSERT INTO Manufacturer_Supplies VALUES (621, 'Dynapower', 'Dynapower@hotmail.com', 'Angel Avenue', 'test');
INSERT INTO Manufacturer_Supplies VALUES (267, 'NCASE', 'NCASE@outlook.com', 'Lincoln Alley', 'test');
INSERT INTO Manufacturer_Supplies VALUES (371, 'Golden Field', 'Golden Field@yahoo.com', 'Cameron Road', 'test');
INSERT INTO Manufacturer_Supplies VALUES (586, 'Dynatron', 'Dynatron@hotmail.com', 'David Avenue', 'test');
INSERT INTO Manufacturer_Supplies VALUES (359, 'Raidmax', 'Raidmax@gmail.com', 'Anthony Road', 'test');
INSERT INTO Manufacturer_Supplies VALUES (749, 'Mars Gaming', 'MarsGaming@outlook.com', 'Alex Alley', 'test');

INSERT INTO categories SET title = 'Motherboard';
INSERT INTO categories SET title = 'Memory';
INSERT INTO categories SET title = 'Storage';
INSERT INTO categories SET title = 'Cooling System';
INSERT INTO categories SET title = 'Central Processing Unit';
INSERT INTO categories SET title = 'Graphics Card';
INSERT INTO categories SET title = 'Case';
INSERT INTO categories SET title = 'Power Supply';