import random

def extractArray(fileName):
    f = open("./sampleData/" + fileName + ".txt", "r")
    s = f.read()
    w = s.split("\n")
    return w

#min and max have to properly divisible by increment!
def genNum(min, max, increment):
    min = min / increment
    max = max / increment
    output = random.randint(min, max)
    return output * increment

def genNumArr(min, max, increment, unique, quantity):
    output = []
    while(len(output) < quantity):
        n = genNum(min, max, increment)
        
        while unique and output.count(n) > 0:
            n = genNum(min, max, increment)
        
        output.append(n)
    return output

def genStr(strArr):
    return str(strArr[genNum(0, len(strArr) - 1, 1)])