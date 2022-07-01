import random
from Util import extractArray
from Util import genNumArr
from Util import genNum
from Util import genStr

MANUFACTURER = extractArray("CaseManufacture")
MODEL = extractArray("CaseModel")
COLORS = extractArray("Colors")
FORMFACTORS = extractArray("MBFormFactors")
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

formFactors = []
while len(formFactors) < ENTRIES:
    formFactors.append(genStr(FORMFACTORS))

output = "Model Name,Color,Form Factor\n"
x = 0
while x < ENTRIES:
    output += modelNames[x] + "," + colors[x] + "," + formFactors[x] + "\n"
    x += 1

outFile = open("./generatedOutput/CaseGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")
