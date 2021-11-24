import React, { useState } from "react";
import { View, StyleSheet } from "react-native";
import { Text, Input, Button } from "react-native-elements";
// npm install react-native-elements //
import Formatter from "../components/Formatter";

const SignUpScreen = ({ navigation }) => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    
    return (
      <View style={styles.container}>
        <Formatter>
            <Text h3>Sign Up</Text>
        </Formatter>
        <Input 
            label="Email"
            value={email}
            onChangeText={setEmail}
            autoCapitalize="none"
            autoCorrect={false}
        />
        <Input 
            secureTextEntry
            label="Password"
            value={password}
            onChangeText={setPassword}
            autoCapitalize="none"
            autoCorrect={false}
            />
        <Formatter>
            <Button title="Sign Up"/>
        </Formatter>
      </View>
    );
  };
  
  const styles = StyleSheet.create({
      container: {
          flex: 1,
          justifyContent: 'center',
          marginBottom: 150
      }
  });

  export default SignUpScreen;