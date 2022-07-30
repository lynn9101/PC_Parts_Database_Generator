from Util import extractArray

MANUFACTURERS = extractArray("Manufacturers")
MANUFACTURERS += extractArray("MemManufacture")

x = 0
mSet = set()
while(x < len(MANUFACTURERS)):
    mSet.add(MANUFACTURERS[x])
    x += 1

output = ""
for manufacture in mSet:
    if(manufacture != ""):
        output += manufacture + "\n"

outFile = open("./sampleData/Manufacturers.txt", "w")
outFile.write(output)
outFile.close()

print("finished reorganising all the manufacturers!")
