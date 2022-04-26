#!/bin/sh
 
if [ "`git show --pretty="" --name-only | grep \\\\\\.php`" != "" ]
then
    STAGED_FILES_CMD=`git show --pretty="" --name-only | grep \\\\\\.php`
else
    exit 0
fi

# Determine if a file list is passed
if [ "$#" -eq 1 ]
then
        oIFS=$IFS
        IFS=\'
        \'
        SFILES="$1"
        IFS=$oIFS
fi
SFILES=${SFILES:-$STAGED_FILES_CMD}

for FILE in $SFILES

do
    if [ -f "$FILE" ] 
    then
        FILES="$FILES $FILE"
    fi
done

[ -f .csignore ] && ignore_file="`tr \'\\n\' \',\' < .csignore |sed \'s/,$//g\'`"
[ -n $ignore_file ] && args=`echo "${args} --ignore=${ignore_file}"`

echo "Running Code Sniffer..."
./vendor/bin/phpcs --standard=custom.xml $args --encoding=utf-8 -n -p $FILES
if [ $? != 0 ]
then
    echo "Errors found not fixable automatically"
    exit 1

fi

exit $?