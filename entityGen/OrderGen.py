from Util import genNumArr

ENTRIES = 25

orderIDs = genNumArr(1, 10000, 1, True, ENTRIES)

output = "order ID\n"
x = 0
while x < ENTRIES:
    output += str(orderIDs[x]) + "\n"
    x += 1

outFile = open("./generatedOutput/OrderGen.csv", "w")
outFile.write(output)
outFile.close()

print("finished generating " + str(ENTRIES) + " entities!")
