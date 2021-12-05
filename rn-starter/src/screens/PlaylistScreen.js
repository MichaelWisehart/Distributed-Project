import React from "react";
import { Text, StyleSheet, View } from "react-native";

const PlaylistScreen = () => {
  return (
    <View>
      <Text style={styles.textHeader}>Playlists</Text>
      <Text style={styles.text}>Create and view playlists here!</Text>
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
