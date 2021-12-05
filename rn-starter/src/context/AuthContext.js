import createDataContext from "./createDataContext";
import AsyncStorage from '@react-native-async-storage/async-storage';
import babyapi from "../api/babyapi" 
import { navigate } from "../navigationRef";
// npm install @react-native-async-storage/async-storage

const authReducer = (state, action) => {
    switch (action.type) {
        case 'add_error':
            return { ...state, errorMessage: action.payload };
        case 'signin':
            return { errorMessage: '', token: action.payload };
        case 'signout':
            return { token: null, errorMessage: '' };
            case 'clear_errorMessage':
            return { ...state, errorMessage: '' };
        default:
            return state;
    }
};

const localSignin = dispatch => async () => {
    const token = await AsyncStorage.getItem('token');
    if (token) {
        dispatch({ type: 'signin', payload: token });
        navigate('mainFlow');
    } else {
        navigate('loginFlow');
    }
};

const clearErrorMessage = dispatch => () => {
    dispatch({ type: 'clear_errorMessage' });
};

const signup = (dispatch) => {
    return async ({ username, email, password }) => {
        try {
            const response = await babyapi.post('/signup', { username, email, password });
            await AsyncStorage.setItem('token', response.data.token);
            dispatch({ type: 'signin', payload: response.data.token });
            navigate('mainFlow');
        } catch (err) {
            dispatch({ type: 'add_error', payload: 'Something went wrong with sign up.'});
        }
        //make api request to sign up with email and pword
        //if we sign up, modify state and authenticate, navigate to main flow
        //if signup fails, reflect error
    };
};

const login = (dispatch) => {
    return async ({ username, password }) => {
        try {
            const response = await babyapi.post('/login', { username, password });
            await AsyncStorage.setItem('token', response.data.token);
            dispatch({ type: 'signin', payload: response.data.token });
            navigate('mainFlow');
        } catch (err) {
            dispatch({ type: 'add_error', payload: 'Something went wrong with log in.'});
        }
        //make api request to sign in with email and pword
        //if we log in, update state
        //if log in fails, reflect error
    };
};

const logout = (dispatch) => {
    return async () => {
        await AsyncStorage.removeItem('token');
        dispatch({ type: 'signout' });
        navigate('loginFlow');
        //signout
    };
};

export const { Provider, Context } = createDataContext(
    authReducer,
    { signup, login, logout, clearErrorMessage, localSignin },
    { token: null, errorMessage: '' }
);