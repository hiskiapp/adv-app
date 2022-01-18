package app.hiskia.advapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;

import app.hiskia.advapp.activities.HomeActivity;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        int load_time = 4000;
        new Handler().postDelayed(() -> {
            Intent home=new Intent(MainActivity.this, HomeActivity.class);
            startActivity(home);
            finish();

        }, load_time);
    }
}