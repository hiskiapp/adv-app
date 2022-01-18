package app.hiskia.advapp.activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;

import app.hiskia.advapp.R;
import app.hiskia.advapp.adapters.WorshipAdapter;
import app.hiskia.advapp.interfaces.WorshipService;
import app.hiskia.advapp.models.WorshipResult;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class HomeActivity extends AppCompatActivity {

    RecyclerView rv_worship;
    public static final String BASE_URL = "https://adv-app.hiskia.app/api/";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        rv_worship = findViewById(R.id.rv_worship);

        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(this,LinearLayoutManager.VERTICAL,false);
        rv_worship.setLayoutManager(layoutManager);
        rv_worship.setHasFixedSize(true);
        getDataWorship();
    }

    void getDataWorship(){
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(BASE_URL)
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        WorshipService service = retrofit.create(WorshipService.class);
        Call<WorshipResult> getResult = service.getResult();
        getResult.enqueue(new Callback<WorshipResult>() {
            @Override
            public void onResponse(Call<WorshipResult> call, Response<WorshipResult> response) {
                WorshipAdapter adapter = new WorshipAdapter(HomeActivity.this,response.body().getResult());
                adapter.notifyDataSetChanged();
                rv_worship.setAdapter(adapter);
            }

            @Override
            public void onFailure(Call<WorshipResult> call, Throwable t) {
                t.printStackTrace();
            }
        });
    }
}