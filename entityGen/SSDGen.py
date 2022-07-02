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

writeSpeeds = genNumArr(200, 2500, 1, False, ENTRIES)

readSpeeds = []
while len(readSpeeds) < ENTRIES:
    readSpeeds.append(writeSpeeds[len(readSpeeds)] + genNum(10, 100, 10))

formFactors = []
while len(formFactors) < ENTRIES:
    formFactors.append(genStr(FORMFACTORS))

output = "storage size,model,write speed,read speed,form factor\n"
x = 0
while x < ENTRIES:
    output += str(pow(2, storageSizes[x])) + " GB," + modelNames[x] + "," + str(writeSpeeds[x]) + " MBps," + str(readSpeeds[x]) + " MBps," + formFactors[x] + "\n"
    x += 1

outFile = open("./generatedOutput/SSDGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")
