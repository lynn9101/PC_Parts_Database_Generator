from Util import extractArray
from Util import genNumArr
from Util import genNum
from Util import genStr

SERIES = extractArray("CPUSeries")
ENTRIES = 25

partIDs = genNumArr(1, 1000, 1, True, ENTRIES)

brandNames = []
while len(brandNames) < ENTRIES:
    brand = genStr(SERIES) + " " + str(genNum(1000, 15000, 100))
    brandNames.append(brand)

coreNums = genNumArr(1, 6, 1, False, ENTRIES)

coreClocks = genNumArr(13, 47, 1, False, ENTRIES)

output = "CPU part ID,brand name,core count,core clock\n"
x = 0
while x < ENTRIES:
    output += str(partIDs[x]) + "," + brandNames[x] + "," + str(pow(2, coreNums[x])) + "," + str(float(coreClocks[x])/float(10)) + "GHz\n"
    x += 1

outFile = open("./generatedOutput/CPUGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")
