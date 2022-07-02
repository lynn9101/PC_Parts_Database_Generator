from Util import extractArray
from Util import genNumArr
from Util import genNum
from Util import genStr

NAMES = extractArray("NameList")
ENTRIES = 25

IDs = genNumArr(1, 10000, 1, True, ENTRIES)

phoneNums = genNumArr(1000000000, 9999999999, 1, False, ENTRIES)

names = []
while len(names) < ENTRIES:
    names.append(genStr(NAMES))

roadTypes = ["Street", "Avenue", "Road", "Highway", "Alley"]
addresses = []
while len(addresses) < ENTRIES:
    addresses.append(genStr(NAMES) + " " + genStr(roadTypes))

output = "UID,phone number,name,address\n"
x = 0
while x < ENTRIES:
    output += str(IDs[x]) + "," + str(phoneNums[x]) + "," + names[x] + "," + addresses[x] + "\n"
    x += 1

outFile = open("./generatedOutput/UserGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")
