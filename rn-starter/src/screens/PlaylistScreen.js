import React from "react";
import { Text, StyleSheet, View } from "react-native";

const PlaylistScreen = () => {
  return (
    <View>
      <Text style={styles.textHeader}>Playlists</Text>
      <Text style={styles.text}>Our team is dedicated to providing our users with quality music at their convience.</Text>
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

export default PlaylistScreen;
