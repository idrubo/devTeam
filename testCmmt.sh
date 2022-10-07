#!/bin/bash

function checkCmmt ()
{
  find . -regex ".*\.php\|.*\.phtml" -exec grep --color -Hn "${1}" '{}' \;
}

checkCmmt 'msgToConsole'
checkCmmt 'varToConsole'
checkCmmt '/\* DEBUG \*/'

exit 0

