from html import entities
import random

BRANDS = ["GeForce GTX", "GeForce RTX", "GeForce GT", "Radeon Pro", "Radeon HD", "Quadro", "FirePro"]
MEMTYPES = ["DDR", "GDDR"]
ENTRIES = 25

partIDs = []
while len(partIDs) < ENTRIES:
    num = random.randint(1, 1000)
    while partIDs.count(num) > 0:
        num = random.randint(1, 1000)
    partIDs.append(num)

models = []
while len(models) < ENTRIES:
    idx = random.randint(0, len(BRANDS) - 1)
    num = random.randint(200, 900) * 10
    model = BRANDS[idx] + " " + str(num)
    models.append(model)

memTypes = []
while len(memTypes) < ENTRIES:
    idx = random.randint(0, len(MEMTYPES) - 1)
    memType = MEMTYPES[idx]
    memTypes.append(memType)

memSizes = []
while len(memSizes) < ENTRIES:
    memSize = random.randint(2, 16) * 2
    memSizes.append(memSize)

boostClocks = []
while len(boostClocks) < ENTRIES:
    boostClock = random.randint(700, 2800)
    boostClocks.append(boostClock)

coreClocks = []
while len(coreClocks) < ENTRIES:
    coreClock = random.randint(100, 2500)
    coreClocks.append(coreClock)

output = "partID,model,memory type,memorysize,boost clock,core clock\n"
x = 0
while x < ENTRIES:
    output += str(partIDs[x]) + "," + models[x] + "," + memTypes[x] + "," + str(memSizes[x]) + " GB," + str(boostClocks[x]) + "MHz," + str(coreClocks[x]) + "MHz\n"
    x += 1

outFile = open("GPUGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")