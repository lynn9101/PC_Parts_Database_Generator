from Util import extractArray
from Util import genNumArr
from Util import genNum
from Util import genStr

MANUFACTURER = extractArray("StorageManufacture")
MODEL = extractArray("StorageModels")
FORMFACTORS = extractArray("StorageFormFactors")
ENTRIES = 25

storageSizes = genNumArr(3, 15, 1, False, ENTRIES)

modelNames = []
while len(modelNames) < ENTRIES:
    manufacturer = genStr(MANUFACTURER)
    model = genStr(MODEL)
    modelName = manufacturer + " " + str(genNum(300, 1200, 10)) + " " + model
    modelNames.append(modelName)

rwSpeeds = genNumArr(60, 255, 1, False, ENTRIES)

RPMs = genNumArr(1200, 15000, 100, False, ENTRIES)

output = "storage size,model,write speed,read speed,RPM\n"
x = 0
while x < ENTRIES:
    output += str(pow(2, storageSizes[x])) + " GB," + modelNames[x] + "," + str(rwSpeeds[x]) + " MBps," + str(rwSpeeds[x]) + " MBps," + str(RPMs[x]) + "RPM\n"
    x += 1

outFile = open("./generatedOutput/HDDGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")
