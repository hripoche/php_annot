# go_import.sh

cd $DB

gunzip $DB/go_*-seqdb-tables.tar.gz
tar xvf $DB/go_*-seqdb-tables.tar
cd $DB/go_*-seqdb-tables
#cat *.sql | mysql $BASE
cat *.sql | mysql -u 'ripoche' -p $BASE
#mysqlimport -L $BASE *.txt
mysqlimport -u 'ripoche' -p -L $BASE *.txt
cd ..
gzip $DB/go_*-seqdb-tables.tar
