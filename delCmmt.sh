#!/bin/bash

# regex='msgToConsole'
# find . -regex ".*\.php\|.*\.phtml" -exec grep --color -Hn "${regex}" '{}' \;

# regex='varToConsole'
# find . -regex ".*\.php\|.*\.phtml" -exec grep --color -Hn "${regex}" '{}' \;

# regex='/\* DEBUG \*/'
# find . -regex ".*\.php\|.*\.phtml" -exec grep --color -Hn "${regex}" '{}' \;

toDel=$(find . -regex ".*\.php")

for f in ${toDel} ; do
  sed '/\* DEBUG \*/d' ${f} >> "${f}.bck"
  mv "${f}.bck" "${f}" 
done

exit 0

