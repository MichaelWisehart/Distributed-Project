import React from "react";
import { Text, StyleSheet, View } from "react-native";

const AboutScreen = () => {
  return (
    <View>
      <Text style={styles.textHeader}>About Page</Text>
      <Text style={styles.text}>Our team is made up of four CSUB students dedicated to providing our users with quality music at their convenience.</Text>
    </View>
  );
};

const styles = StyleSheet.create({
  textHeader: {
    fontSize: 50
  },
  text: {
    fontSize: 30
  }
});

export default AboutScreen;
