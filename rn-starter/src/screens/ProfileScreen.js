import React, { useContext } from "react";
import { Text, StyleSheet, View } from "react-native";
import { Button } from "react-native-elements";
import Formatter from "../components/Formatter";
import { Context as AuthContext } from "../context/AuthContext";

const ProfileScreen = () => {
  const { signout } = useContext(AuthContext);

  return (
    <View>
      <Text style={styles.textHeader}>Profile</Text>
      <Text style={styles.text}>Customize profile here.</Text>
      <Formatter>
        <Button title="Sign Out" onPress={signout}/>
      </Formatter>
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

export default ProfileScreen;
