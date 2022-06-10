from Util import extractArray
from Util import genNumArr
from Util import genNum
from Util import genStr

BRANDS = extractArray("GPUBrands")
MEMTYPES = extractArray("GPUMemTypes")
ENTRIES = 25

partIDs = genNumArr(1, 1000, 1, True, ENTRIES)

models = []
while len(models) < ENTRIES:
    model = genStr(BRANDS) + " " + str(genNum(200, 900, 10))
    models.append(model)

memTypes = []
while len(memTypes) < ENTRIES:
    memTypes.append(genStr(MEMTYPES))

memSizes = genNumArr(2, 16, 2, False, ENTRIES)

boostClocks = genNumArr(700, 2800, 1, False, ENTRIES)

coreClocks = genNumArr(100, 2500, 1, False, ENTRIES)

output = "GPU part ID,model,memory type,memorysize,boost clock,core clock\n"
x = 0
while x < ENTRIES:
    output += str(partIDs[x]) + "," + models[x] + "," + memTypes[x] + "," + str(memSizes[x]) + " GB," + str(boostClocks[x]) + "MHz," + str(coreClocks[x]) + "MHz\n"
    x += 1

outFile = open("./generatedOutput/GPUGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")
