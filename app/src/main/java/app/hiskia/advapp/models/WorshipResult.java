package app.hiskia.advapp.models;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class WorshipResult {
    @SerializedName("result")
    ArrayList<Worship> result;

    public ArrayList<Worship> getResult() {
        return result;
    }

    public void setResult(ArrayList<Worship> result) {
        this.result = result;
    }
}
