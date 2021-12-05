import React from "react";
import { createAppContainer, createSwitchNavigator } from "react-navigation";
import { createStackNavigator } from "react-navigation-stack";
import HomeScreen from "./src/screens/HomeScreen";
import AboutScreen from "./src/screens/AboutScreen";
import ProfileScreen from "./src/screens/ProfileScreen";
import PlaylistScreen from "./src/screens/PlaylistScreen";
import MerchScreen from "./src/screens/MerchScreen";
import SignUpScreen from "./src/screens/SignUpScreen";
import LoginScreen from "./src/screens/LoginScreen";
import TokenScreen from "./src/screens/TokenScreen";
import { Provider as AuthProvider } from "./src/context/AuthContext";
import { setNavigator } from "./src/navigationRef";

const switchNavigator = createSwitchNavigator({
  Token: TokenScreen,
  loginFlow: createStackNavigator({
    SignUp: SignUpScreen,
    Login: LoginScreen,
  },
  {
    initialRouteName: "SignUp",
    defaultNavigationOptions: {
      title: "Headliner Mobile Music Club",
    },
  }),
  mainFlow: createStackNavigator({
    Home: HomeScreen,
    Profile: ProfileScreen,
    Playlist: PlaylistScreen,
    Merch: MerchScreen,
    About: AboutScreen,
  },
  {
    initialRouteName: "Home",
    defaultNavigationOptions: {
      title: "Headliner Mobile Music Club",
    },
  }),
});

const App = createAppContainer(switchNavigator);

export default () => {
  return (
    <AuthProvider>
      <App ref={(navigator) => { setNavigator(navigator) }} />
    </AuthProvider>
  );
};