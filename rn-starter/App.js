import { createAppContainer } from "react-navigation";
import { createStackNavigator } from "react-navigation-stack";
import HomeScreen from "./src/screens/HomeScreen";
import AboutScreen from "./src/screens/AboutScreen";
import ProfileScreen from "./src/screens/ProfileScreen";
import PlaylistScreen from "./src/screens/PlaylistScreen";
import MerchScreen from "./src/screens/MerchScreen";
import SignUpScreen from "./src/screens/SignUpScreen";

const navigator = createStackNavigator(
  {
    Home: HomeScreen,
    Profile: ProfileScreen,
    Playlist: PlaylistScreen,
    Merch: MerchScreen,
    About: AboutScreen,
    SignUp: SignUpScreen,
  },
  {
    initialRouteName: "SignUp",
    defaultNavigationOptions: {
      title: "Headliner Mobile Music Club",
    },
  }
);

export default createAppContainer(navigator);
