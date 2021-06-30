cd "$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )/../";
rsync -av assets/public/ var/public --delete
touch var/etc/version
