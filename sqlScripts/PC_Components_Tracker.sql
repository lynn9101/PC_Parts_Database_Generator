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
FOREIGN KEY (model) REFERENCES HDDStorage2(model) );

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
FOREIGN KEY (modelname) REFERENCES CoolingSystem1(modelname) );

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
FOREIGN KEY (modelname) REFERENCES PowerSupply1(modelname) );

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

CREATE TABLE Manufacturer_Supplies1
(name CHAR(20) NOT NULL,
contactinfo CHAR(50) NOT NULL,
address CHAR(100) NOT NULL,
PRIMARY KEY (name) );

CREATE TABLE Manufacturer_Supplies2
(id INT NOT NULL,
name CHAR(20) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (name) REFERENCES Manufacturer_Supplies1(name) );

CREATE TABLE Manufacturer_Supplies3
(manufacturerid INT NOT NULL,
orderid INT NOT NULL,
userid INT NOT NULL,
PRIMARY KEY (manufacturerid, orderid, userid),
FOREIGN KEY (manufacturerid) REFERENCES Manufacturer_Supplies2(id),
FOREIGN KEY (userid, orderid) REFERENCES OrderPCPart_Orders(userid, orderid) );
