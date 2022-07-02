from Util import extractArray
from Util import genNumArr
from Util import genNum
from Util import genStr

MANUFACTURER = extractArray("CoolSysManufacture")
MODEL = extractArray("CoolSysModels")
COLORS = extractArray("Colors")
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

noiseLevels = genNumArr(0, 50, 1, False, ENTRIES)

output = "Cooling System Model Name,Color,Noise levels\n"
x = 0
while x < ENTRIES:
    output += modelNames[x] + "," + colors[x] + "," + str(noiseLevels[x]) + "dB\n"
    x += 1

outFile = open("./generatedOutput/CoolSysGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")
