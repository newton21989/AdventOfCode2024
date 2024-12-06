import os

if __name__ == "__main__":
  filename = './day04/day4.txt'

  if not os.path.isfile(filename):
    print("Error: input file does not exist.")
    exit
  else:
    with open(filename, 'r') as f:
      read = f.read().rstrip()
      lines = read.splitlines(0)
      f.close()

  out1 = 0
  lineNum = 0
  for line in lines:
    col = 0
    for char in line:
      if char == "X":
        if lineNum >= 3 and col >= 3:
          if lines[lineNum - 1][col - 1] == "M" and lines[lineNum - 2][col - 2] == "A" and lines[lineNum - 3][col - 3] == "S":
            out1 += 1

        if lineNum >= 3:
          if lines[lineNum - 1][col] == "M" and lines[lineNum - 2][col] == "A" and lines[lineNum - 3][col] == "S":
            out1 += 1

        if lineNum >= 3 and col < len(line) - 3:
          if lines[lineNum - 1][col + 1] == "M" and lines[lineNum - 2][col + 2] == "A" and lines[lineNum - 3][col + 3] == "S":
            out1 += 1

        if col >= 3:
          if lines[lineNum][col - 1] == "M" and lines[lineNum][col - 2] == "A" and lines[lineNum][col - 3] == "S":
            out1 += 1

        if col < len(line) - 3:
          if lines[lineNum][col + 1] == "M" and lines[lineNum][col + 2] == "A" and lines[lineNum][col + 3] == "S":
            out1 += 1

        if lineNum < len(lines) - 3 and col >= 3:
          if lines[lineNum + 1][col - 1] == "M" and lines[lineNum + 2][col - 2] == "A" and lines[lineNum + 3][col - 3] == "S":
            out1 += 1

        if lineNum < len(lines) - 3:
          if lines[lineNum + 1][col] == "M" and lines[lineNum + 2][col] == "A" and lines[lineNum + 3][col] == "S":
            out1 += 1

        if lineNum < len(lines) - 3 and col < len(line) - 3:
          if lines[lineNum + 1][col + 1] == "M" and lines[lineNum + 2][col + 2] == "A" and lines[lineNum + 3][col + 3] == "S":
            out1 += 1

      col += 1
    lineNum += 1

out2 = 0
lineNum = 0
for line in lines:
  col = 0
  for char in line:
    if lineNum >= 1 and col >= 1 and lineNum < len(lines) - 1 and col < len(line) - 1:
      if char == "A":
        nw = lines[lineNum - 1][col - 1]
        ne = lines[lineNum - 1][col + 1]
        sw = lines[lineNum + 1][col - 1]
        se = lines[lineNum + 1][col + 1]
        nwneswse = ''.join([nw, ne, sw, se])

        if nwneswse in ("MMSS", "MSMS", "SMSM", "SSMM"):
          out2 += 1

    col += 1
  lineNum += 1

print(f"Part 1: {out1}")
print(f"Part 2: {out2}")
