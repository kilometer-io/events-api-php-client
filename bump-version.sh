#!/usr/bin/env bash

_SCRIPT="$(readlink -f ${BASH_SOURCE[0]})"
_MYDIR="$(dirname ${_SCRIPT})"

#if [ $# -lt 1 ]
#then
#    echo "Error! Please specify release version."
#    exit 1
#fi

VERSION=$(cat $_MYDIR/version)

# Update "version" file
echo "$1" > $_MYDIR/version