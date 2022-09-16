#!/bin/bash

sPath='./'

[ "${#}" != "0" ] && sPath="${1}"

phpF=$(find "${sPath}" -name '*.php')

for f in ${phpF} ; do
	sed -i 's/\(\/\* DEBUG \*\/\)/\/\/ \1/' ${f}
done

exit 0

