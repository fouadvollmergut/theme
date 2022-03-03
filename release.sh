#!/bin/bash

if [ $# -eq 0 ]; then
    echo "Please supply the version number as an argument."
fi

# Build project
npm run build:prod

cd dist

# Create repo for current release
git init
git remote add origin "git@github.com:fouadvollmer/theme.git"
git checkout -b release/v$1

git add .
git commit -m "Release v$1"
git tag -a v$1 -m "Release v$1"
git push origin --tags

# Exit and delete build repo
cd -
rm -rf dist