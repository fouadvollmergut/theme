#!/bin/zsh

if [ $# -eq 0 ]; then
    echo "Please supply the version number as an argument."
fi

read -p "Releaseing Version $1. Did you push all necessary changes to master? (y/n) " remember

if [ $remember != 'y' ]; then 
    echo "\nCome back when you are ready! Aborting Release …"
    exit 1
fi

# Set release version
git checkout -b release/v$1 origin/master

sed -i '' -E "s/\"version\": \".*\"/\"version\": \"$1\"/" package.json
sed -i '' -E "s/Version: .*/Version: $1/" style.css

git add package.json style.css
git commit -m "Release $1"
git tag -a v$1 -m "Release Version $1"
git push origin --tags
git push origin release/v$1

git co master