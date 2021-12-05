import React from "react";
import { Text, StyleSheet, View } from "react-native";

const MerchScreen = () => {
  return (
    <View>
      <Text style={styles.textHeader}>Merch Store</Text>
      <Text style={styles.text}>Check out our merch!</Text>
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

export default MerchScreen;
