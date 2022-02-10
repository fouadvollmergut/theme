#!/bin/bash

if [ $# -eq 0 ]
  then
    echo "Please supply the version number as an argument"
fi

npm run build:prod

cd dist

git init
git remote add origin "git@github.com:fouadvollmer/theme.git"
git checkout -b release/v$1

git add .
git commit -m "Release v$1"
git tag -a v$1 -m "Release v$1"
git push origin --tags

cd -

rm -rf dist