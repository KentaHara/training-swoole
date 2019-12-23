FROM centos:7.7.1908

RUN yum install -y epel-release && \
    yum update -y && \
	yum -y install http://rpms.famillecollet.com/enterprise/remi-release-7.rpm && \
	yum update -y && \
	yum -y install --enablerepo=remi,remi-php73 \
		php php-devel php-mbstring \
		php-pdo php-gd php-xml php-mcrypt php-pear \
		openssl && \
	yum -y install make vim && \
	curl -OL https://github.com/swoole/swoole-src/archive/v4.4.13.tar.gz && \
	tar -zxvf v4.4.13.tar.gz && rm -f v4.4.13.tar.gz && \
	cd swoole-src-4.4.13 && phpize && ./configure && make && make install && \
	cd - && rm -rf swoole-src-4.4.13/ && \
	echo "extension=swoole.so" >> /etc/php.ini