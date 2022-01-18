package app.hiskia.advapp.interfaces;

import app.hiskia.advapp.models.WorshipResult;
import retrofit2.Call;
import retrofit2.http.GET;

public interface WorshipService {
    @GET("worship_list")
    Call<WorshipResult> getResult();
}
