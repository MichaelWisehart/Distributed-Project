import React, { useEffect, useContext} from "react";
import { Context as AuthContext } from "../context/AuthContext";

const TokenScreen = () => {
    const { localSignin } = useContext(AuthContext);
    useEffect( () => {
        localSignin();
    }, []);
    return null;
};

export default TokenScreen;