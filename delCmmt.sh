#!/bin/bash

toDel=$(find . -regex ".*\.php")

for f in ${toDel} ; do
  sed '/\* DEBUG \*/d' ${f} >> "${f}.bck"
  mv "${f}.bck" "${f}" 
done

exit 0

