import React from "react";
import { View, StyleSheet } from "react-native";

const Formatter = ({ children }) => {
    return <View style={styles.formatter}>{children}</View>;
};

const styles = StyleSheet.create({
    formatter: {
        margin: 15
    }
});

export default Formatter;