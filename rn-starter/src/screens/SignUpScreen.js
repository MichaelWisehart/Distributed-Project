import React, { useState, useContext } from "react";
import { View, StyleSheet, TouchableOpacity } from "react-native";
import { Text, Input, Button } from "react-native-elements";
import { NavigationEvents } from "react-navigation";
import Formatter from "../components/Formatter";
import { Context as AuthContext } from "../context/AuthContext";
// npm install react-native-elements //

const SignUpScreen = ({ navigation }) => {
    const { state, signup, clearErrorMessage } = useContext(AuthContext);
    const [username, setUsername] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    return (
      <View style={styles.container}>
        <NavigationEvents onWillFocus={clearErrorMessage} />
        <Formatter>
            <Text h3>Sign Up</Text>
            <Text style={styles.text}>Register for an account below</Text>
        </Formatter>
        <Input 
            label="Username"
            value={username}
            onChangeText={setUsername}
            autoCapitalize="none"
            autoCorrect={false}
        />
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
        {state.errorMessage ? (<Text style={styles.errMessage}>{state.errorMessage}</Text>) : null}
        <Formatter>
            <Button title="Sign Up" onPress={() => signup({ username, email, password })}/>
        </Formatter>
        <TouchableOpacity onPress={() => navigation.navigate('Login')}>
            <Formatter>
                <Text style={styles.link}>Already have an an account? Log in instead</Text>     
            </Formatter>
        </TouchableOpacity>
      </View>
    );
  };
  
  /*LoginScreen.navigationOptions = () => {
    return {
        headerShown: false,
    };
  };*/

  const styles = StyleSheet.create({
      container: {
        flex: 1,
        justifyContent: 'center',
        // marginBottom: 100
      },
      text: {
        fontSize: 16,
        color: 'gray'
      },
      link: {
        color: 'blue'
      },
      errMessage: {
        fontSize: 16,
        color: 'red',
        marginLeft: 15,
        marginTop: 15,
      }
  });

  export default SignUpScreen;