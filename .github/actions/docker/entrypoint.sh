#!/bin/sh -e

echo "::debug ::Debug Message"
echo "::warning ::Warning Message"
echo "::error ::Error Message"

echo "::add-mask::$1"
echo "Hello $1"
time=$(date)
echo "::set-output  name=time::$time"

echo "::group::Expandable Logs"
echo "logs 1"
echo "logs 2"
echo "logs 3"
echo "::endgroup"

echo "HELLO=hello" >> $GITHUB_ENV
# echo "::set-env name=HELLO::hello"

if [ true ]
then
    echo 'throw exception'
    exit 1
fi