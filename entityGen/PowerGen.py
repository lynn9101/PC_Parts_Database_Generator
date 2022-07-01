from Util import extractArray
from Util import genNumArr
from Util import genNum
from Util import genStr

MANUFACTURER = extractArray("PowerManufacture")
MODEL = extractArray("PowerModels")
COLORS = extractArray("Colors")
MODULARITY = extractArray("PowerModularity")
ENTRIES = 25

modelNames = []
while len(modelNames) < ENTRIES:
    manufacturer = genStr(MANUFACTURER)
    model = genStr(MODEL)
    modelName = manufacturer + " " + model
    modelNames.append(modelName)

colors = []
while len(colors) < ENTRIES:
    multi = genNum(0,1,1)
    if(multi == 0):
        colors.append(genStr(COLORS))
    else:
        colors.append(genStr(COLORS) + "/" + genStr(COLORS))

wattages = genNumArr(180, 2000, 10, False, ENTRIES)

modularities = []
while len(modularities) < ENTRIES:
    modularities.append(genStr(MODULARITY))

output = "Power Supply Model Name,Color,Watts,Modularity\n"
x = 0
while x < ENTRIES:
    output += modelNames[x] + "," + colors[x] + "," + str(wattages[x]) + "W," + modularities[x] + "\n"
    x += 1

outFile = open("./generatedOutput/PowerGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")
