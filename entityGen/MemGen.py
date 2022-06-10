from Util import extractArray
from Util import genNumArr
from Util import genNum
from Util import genStr

FORMFACTORS = extractArray("MemFormFactors")
ENTRIES = 25

partIDs = genNumArr(1, 1000, 1, True, ENTRIES)

memSpeeds = []
while len(memSpeeds) < ENTRIES:
    speed = genNum(400, 6800, 400)
    modelNum = int(speed / 1400)
    if(speed % 1400 > 0):
        modelNum += 1
    memSpeed = "DDR" + str(modelNum) + "-" + str(speed)
    memSpeeds.append(memSpeed)

sizes = genNumArr(0, 7, 1, False, ENTRIES)

formFactors = []
while len(formFactors) < ENTRIES:
    formFactors.append(genStr(FORMFACTORS))

output = "Memory part ID,speed,memory size,form factor\n"
x = 0
while x < ENTRIES:
    output += str(partIDs[x]) + "," + memSpeeds[x] + "," + str(pow(2, sizes[x])) + " GB," + formFactors[x] + "\n"
    x += 1

outFile = open("./generatedOutput/MemGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")
