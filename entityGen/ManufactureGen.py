from Util import extractArray
from Util import genNumArr
from Util import genNum
from Util import genStr

MANUFACTURERS = extractArray("Manufacturers")
NAMES = extractArray("NameList")
ENTRIES = 25

ManufactureIDs = genNumArr(1, 1000, 1, True, ENTRIES)

manufactureNames = []
while len(manufactureNames) < ENTRIES:
    manufactureNames.append(genStr(MANUFACTURERS))

roadTypes = ["Street", "Avenue", "Road", "Highway", "Alley"]
addresses = []
while len(addresses) < ENTRIES:
    addresses.append(genStr(NAMES) + " " + genStr(roadTypes))

emails = ["hotmail", "gmail", "yahoo", "outlook", "iCloud"]
contactInfos = []
while len(contactInfos) < ENTRIES:
    contactInfos.append(manufactureNames[len(contactInfos)] + "@" + genStr(emails) + ".com")

output = "manufacture ID,name,address,contact information\n"
x = 0
while x < ENTRIES:
    output += str(ManufactureIDs[x]) + "," + manufactureNames[x] + "," + addresses[x] + "," + contactInfos[x] + "\n"
    x += 1

outFile = open("./generatedOutput/ManufactureGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")
