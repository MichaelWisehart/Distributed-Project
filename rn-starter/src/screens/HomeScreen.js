import React from "react";
import { Text, StyleSheet, View, TouchableOpacity } from "react-native";

const HomeScreen = ({ navigation }) => {
  return (
  <View>
    <Text style={styles.textHeader}>Home Screen</Text>
    <Text style={styles.text}>New Releases!     Updated 11/09/2021</Text>
    <Text style={styles.text}>TOP 10 MIXES</Text>
    <TouchableOpacity onPress={() => navigation.navigate('Playlist')}>
      <Text>My Playlists</Text>
    </TouchableOpacity>
    <TouchableOpacity onPress={() => navigation.navigate('Merch')}>
      <Text>Merch Store</Text>
    </TouchableOpacity>
    <TouchableOpacity onPress={() => navigation.navigate('Profile')}>
      <Text>Profile</Text>
    </TouchableOpacity>
    <TouchableOpacity onPress={() => navigation.navigate('About')}>
      <Text>About Us</Text>
    </TouchableOpacity>
  </View>
    );
};

const styles = StyleSheet.create({
  textHeader: {
    fontSize: 40
  },
  text: {
    fontSize: 20
  }
});

export default HomeScreen;
