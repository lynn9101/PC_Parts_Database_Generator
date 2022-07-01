from Util import extractArray
from Util import genNumArr
from Util import genNum
from Util import genStr

CHIPSETS = extractArray("MBChipsets")
FORMFACTORS = extractArray("MBFormFactors")
ENTRIES = 25

partIDs = genNumArr(1, 1000, 1, True, ENTRIES)

chipsets = []
while len(chipsets) < ENTRIES:
    chipsets.append(genStr(CHIPSETS))

formFactors = []
while len(formFactors) < ENTRIES:
    formFactors.append(genStr(FORMFACTORS))

memorySlots = genNumArr(2, 16, 2, False, ENTRIES)

supportedMemorySizes = genNumArr(6, 12, 1, False, ENTRIES)

output = "Motherboard part ID,Chipset,Form factor,Memory slots,Supported memory size\n"
x = 0
while x < ENTRIES:
    output += str(partIDs[x]) + "," + chipsets[x] + "," + formFactors[x] + "," + str(memorySlots[x]) + "," + str(pow(2, supportedMemorySizes[x])) + " GB" + "\n"
    x += 1

outFile = open("./generatedOutput/MBGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")
