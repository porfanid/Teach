#!/bin/bash
FILE=/var/lib/mysql-files/Lessons.txt
NEW_FILE=/var/lib/mysql-files/myLessons.txt
if [ -f "$NEW_FILE" ] ; then
    rm "$NEW_FILE"
fi

# Check if the number of rows is multiple of 25
numRows=`cat "$FILE" |wc -l`
numRows=$((numRows+1))
echo $numRows
if [ `echo "$numRows % 25" | bc` -eq 0 ]; then
	echo "File is OK"
else
	echo "More lines than expected"
fi

# Delete ^M character from DOS
sed -e "s///" $FILE > /tmp/Lessons.txt
cp /tmp/Lessons.txt $FILE
# rm /tmp/Lessons.txt 

while IFS='' read -r LINE || [[ -n "$LINE" ]]; do
#	echo $LINE
   if [ "$LINE" = "END" ]; then
       echo "$TEXT" >>  $NEW_FILE
#       echo "$TEXT" 
	# Initialize $TEXT
       TEXT=""
   else
	TEMP_TEXT=$TEXT$LINE";"
	TEXT=$TEMP_TEXT
   fi
done < $FILE


#Checkin File

initRows=`cat "$FILE" |grep "END" |wc -l`
finalRows=`cat "$NEW_FILE"  |wc -l`

if [ "$initRows" = "$finalRows" ]; then
   echo "Check Passed"
else   
   echo "ERROR!!! Please check input file"
fi	   


mysql -u "root" "-p" "teach" -e "LOAD DATA INFILE '/var/lib/mysql-files/myLessons.txt' INTO TABLE lessons FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' ( @col1, @col2, @col3, @col4, @col5, @col6, @col7, @col8, @col9, @col10, @col11, @col12, @col13, @col14, @col15, @col16, @col17, @col18, @col19, @col20, @col21, @col22, @col23, @col24 ) set lessonID=@col1,  department=@col2, field=@col3, titleA=@col4, semesterA=@col5, ectsA=@col6, hoursA=@col7,categoryA=@col8, descriptionA=@col9, titleB=@col10, semesterB=@col11, ectsB=@col12, hoursB=@col13, categoryB=@col14, descriptionB=@col15, titleC=@col16, semesterC=@col17, ectsC=@col18, hoursC=@col19, categoryC=@col20, descriptionC=@col21, examiner1=@col22, examiner2=@col23, examiner3=@col24;"
