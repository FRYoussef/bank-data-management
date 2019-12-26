# bank-data-management

## Installation
There are conflicts between hadoop, hive and java versions, so use the following setup and everything is gonna be allrigth.
  
  * Hadoop: 3.1.2
  * Hive: 2.3.6
  * Java: openjdk 11.0.5
### Hadoop Stand-Alone Mode
Use the following [guide](https://www.digitalocean.com/community/tutorials/how-to-install-hadoop-in-stand-alone-mode-on-ubuntu-18-04) in order to install hadoop in a stand alone mode.
### Hive Stand-Alone Mode
  1. Download the hive file from http://archive.apache.org/dist/hive, for example:</br>
     <b>% wget http://archive.apache.org/dist/hive/hive-2.3.6/apache-hive-2.3.6-bin.tar.gz</b>
     
  2. Extract the file with:</br>
     <b>% tar -xzf apache-hive-2.3.6-bin.tar.gz</b>
     
  3. Add hive path to .bashrc file (located in $HOME)</br>
     <b>% nano .bashrc</b>
     
     Add at the end of the file the following statements:</br>
     <b># Set Hadoop vars</br>
        export HADOOP_HOME=/usr/local/hadoop</br>
        export HIVE_HOME=\<where your hive file is extracted\>/apache-hive-2.3.6-bin</br>
        export PATH=$PATH:$HADOOP_HOME/bin:$HADOOP_HOME/sbin:$HIVE_HOME/bin</br>
        </b>
  4. Reload the script with:</br>
     <b>% source .bashrc</b>
     
  5. Install the following packages:</br>
     (Ubuntu) <b>% sudo apt install derby-tools libderby-java libderbyclient-java</b>
     
  6. Launch this command ,where you are gonna work, in order to initialize metastore_db:</br>
     <b>% schematool -initSchema -dbType derby</b>
     
  7. Now, you can launch hive in stand alone mode:</br>
     <b>% hive</b>
  
  8. Test it, with:</br>
     <b>hive> show tables;</br>
        OK</br>
        Time taken: 0.803 seconds</b>
