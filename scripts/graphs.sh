#!/bin/sh
ChartFile=/var/www/teach.orfanidis.xyz/docs/admin/chart.src
ROOT=`pwd`
File=$ROOT/data.dat
Template=$ROOT/chart.template
/usr/bin/php $ROOT/lessons.php > $File

i=0
while IFS= read -r line
do
  i=$(( $i + 1 ))

  if [ $i -eq 1 ] 
   then
    Lessons1=`echo "$line" | awk '{ print $1 }' `
    Applications1=`echo "$line" | awk '{ print $2 }' `
    Rated1=`echo "$line" | awk '{ print $3 }' `
    Date1=`echo "$line" | awk '{ print $4 }' `
  elif [ $i -eq 2 ] 
   then
    Lessons2=`echo "$line" | awk '{ print $1 }' `
    Applications2=`echo "$line" | awk '{ print $2 }' `
    Rated2=`echo "$line" | awk '{ print $3 }' `
    Date2=`echo "$line" | awk '{ print $4 }' `
  elif [ $i -eq 3 ] 
   then
    Lessons3=`echo "$line" | awk '{ print $1 }' `
    Applications3=`echo "$line" | awk '{ print $2 }' `
    Rated3=`echo "$line" | awk '{ print $3 }' `
    Date3=`echo "$line" | awk '{ print $4 }' `
  elif [ $i -eq 4 ] 
   then
    Lessons4=`echo "$line" | awk '{ print $1 }' `
    Applications4=`echo "$line" | awk '{ print $2 }' `
    Rated4=`echo "$line" | awk '{ print $3 }' `
    Date4=`echo "$line" | awk '{ print $4 }' `
  elif [ $i -eq 5 ] 
   then
    Lessons5=`echo "$line" | awk '{ print $1 }' `
    Applications5=`echo "$line" | awk '{ print $2 }' `
    Rated5=`echo "$line" | awk '{ print $3 }' `
    Date5=`echo "$line" | awk '{ print $4 }' `
  elif [ $i -eq 6 ] 
   then
    Lessons6=`echo "$line" | awk '{ print $1 }' `
    Applications6=`echo "$line" | awk '{ print $2 }' `
    Rated6=`echo "$line" | awk '{ print $3 }' `
    Date6=`echo "$line" | awk '{ print $4 }' `
  elif [ $i -eq 7 ] 
   then
    Lessons7=`echo "$line" | awk '{ print $1 }' `
    Applications7=`echo "$line" | awk '{ print $2 }' `
    Rated7=`echo "$line" | awk '{ print $3 }' `
    Date7=`echo "$line" | awk '{ print $4 }' `
  fi

done < "$File"

cat $Template \
| sed "s/%%date1%%/${Date1}/g; s/%%date2%%/${Date2}/g; s/%%date3%%/${Date3}/g; s/%%date4%%/${Date4}/g; s/%%date5%%/${Date5}/g; s/%%date6%%/${Date6}/g; s/%%date7%%/${Date7}/g"  \
| sed "s/%%applications1%%/${Applications1}/g; s/%%applications2%%/${Applications2}/g; s/%%applications3%%/${Applications3}/g; s/%%applications4%%/${Applications4}/g; s/%%applications5%%/${Applications5}/g; s/%%applications6%%/${Applications6}/g; s/%%applications7%%/${Applications7}/g" \
| sed "s/%%lessons1%%/${Lessons1}/g; s/%%lessons2%%/${Lessons2}/g; s/%%lessons3%%/${Lessons3}/g; s/%%lessons4%%/${Lessons4}/g; s/%%lessons5%%/${Lessons5}/g; s/%%lessons6%%/${Lessons6}/g; s/%%lessons7%%/${Lessons7}/g" \
| sed "s/%%rated1%%/${Rated1}/g; s/%%rated2%%/${Rated2}/g; s/%%rated3%%/${Rated3}/g; s/%%rated4%%/${Rated4}/g; s/%%rated5%%/${Rated5}/g; s/%%rated6%%/${Rated6}/g; s/%%rated7%%/${Rated7}/g"   > ${ChartFile}
