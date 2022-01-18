package app.hiskia.advapp.adapters;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.constraintlayout.widget.ConstraintLayout;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;

import java.util.ArrayList;

import app.hiskia.advapp.R;
import app.hiskia.advapp.models.Worship;

public class WorshipAdapter extends RecyclerView.Adapter<WorshipAdapter.ViewHolder> {

    ArrayList<Worship> result;
    Context context;

    public WorshipAdapter(Context context, ArrayList<Worship> result) {
        super();
        this.result = result;
        this.context = context;
    }

    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater inflater = LayoutInflater.from(parent.getContext());
        ViewHolder holder = new ViewHolder(inflater.inflate(R.layout.worship_list_item, parent, false));

        return holder;
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, @SuppressLint("RecyclerView") int position) {
        Glide.with(context).load(result.get(position).getPoster()).diskCacheStrategy(DiskCacheStrategy.ALL).into(holder.iv_poster);
        holder.tv_datetime.setText(result.get(position).getDatetime());
        holder.tv_title.setText(result.get(position).getTitle());
        holder.tv_speaker.setText(result.get(position).getSpeaker());
        holder.tv_media.setText(result.get(position).getMedia());

        holder.itemLayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(Intent.ACTION_VIEW,
                        Uri.parse(result.get(position).getLink()));
                context.startActivity(intent);
            }
        });
    }

    @Override
    public int getItemCount() {
        return result.size();
    }

    class ViewHolder extends RecyclerView.ViewHolder{
        ImageView iv_poster;
        TextView tv_datetime,tv_title,tv_speaker,tv_media;
        public ConstraintLayout itemLayout;

        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            iv_poster = (ImageView) itemView.findViewById(R.id.iv_poster);
            tv_datetime = itemView.findViewById(R.id.tv_datetime);
            tv_title = itemView.findViewById(R.id.tv_title);
            tv_speaker = itemView.findViewById(R.id.tv_speaker);
            tv_media = itemView.findViewById(R.id.tv_media);
            itemLayout = itemView.findViewById(R.id.layout_item);
        }
    }
}