using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Drawing.Imaging;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApplication21
{
    public partial class Form1 : Form
    {
        int cR, cG, cB;
        int r1, r2, r3, g1, g2, g3, b1, b2, b3;
        
        public Form1()
        {
            InitializeComponent();
            r1 = r2 = r3 = g1 = g2 = g3 = b1 = b2 = b3 = 0;
            llenarCombo();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            openFileDialog1.ShowDialog();
            Bitmap bmp = new Bitmap(openFileDialog1.FileName);
            pictureBox1.Image = bmp;
        }
        /*
        private void button2_Click(object sender, EventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Color c = new Color();
            c = bmp.GetPixel(10,10);
            textBox1.Text = c.R.ToString();
            textBox2.Text = c.G.ToString();
            textBox3.Text = c.B.ToString();
        }
        */
        private void pictureBox1_MouseClick(object sender, MouseEventArgs e)
        {
            /*Bitmap bmp = new Bitmap(pictureBox1.Image);
            Color c = new Color();
            c = bmp.GetPixel(e.X, e.Y);
            textBox1.Text = c.R.ToString();
            textBox2.Text = c.G.ToString();
            textBox3.Text = c.B.ToString();
            cR = c.R;
            cG = c.G;
            cB = c.B;*/
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Color c = new Color();
            int x, y, mR=0, mG=0, mB=0;
            x = e.X; y = e.Y;
            for (int i = x; i < x + 10;i++)
                for (int j = y; j < y + 10; j++)
                {
                    c = bmp.GetPixel(i, j);
                    mR = mR + c.R;
                    mG = mG + c.G;
                    mB = mB + c.B;
                }
            mR = mR / 100;
            mG = mG / 100;
            mB = mB / 100;
            cR = mR;
            cG = mG;
            cB = mB;
            textBox1.Text = cR.ToString();
            textBox2.Text = cG.ToString();
            textBox3.Text = cB.ToString();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap cpoa = new Bitmap(bmp.Width, bmp.Height);
            Color c = new Color();
            MemoryStream ms = new MemoryStream();
            bmp.Save(ms, ImageFormat.Gif);
            byte[] imgArr = ms.ToArray();
            /*
            MySqlConnection con = new MySqlConnection();
            MySqlDataAdapter ada = new MySqlDataAdapter();
            con.ConnectionString = "Server=localhost;UserID=root;Database=texturas;Password=moises123;";
            ada.SelectCommand = new MySqlCommand();
            ada.SelectCommand.Connection = con;
            ada.SelectCommand.CommandText = "INSERT INTO imagen(img) VALUES (@imgArr)";
            ada.SelectCommand.Parameters.AddWithValue("@imgArr", imgArr);
            ada.SelectCommand.ExecuteNonQuery();*/

            using (MySqlConnection con = new MySqlConnection())
            {
                con.ConnectionString = "Server=localhost;UserID=root;Database=texturas;Password=moises123;";
                con.Open();
                using (MySqlCommand cmd = new MySqlCommand())
                {
                    cmd.Connection = con;
                    cmd.CommandText = "INSERT INTO imagen(nombre,img) VALUES (@nom,@imgArr)";
                    cmd.Parameters.AddWithValue("@nom", Convert.ToString(txtNombre.Text));
                    cmd.Parameters.AddWithValue("@imgArr", imgArr);
                    cmd.ExecuteNonQuery();
                }
            }

            using (MySqlConnection con = new MySqlConnection())
            {
                con.ConnectionString = "Server=localhost;UserID=root;Database=texturas;Password=moises123;";
                con.Open();
                MySqlCommand cmd = new MySqlCommand("select max(cod) cod from imagen", con);
                MySqlDataReader reader = cmd.ExecuteReader();

                if (reader.HasRows)
                {
                    reader.Read();
                    txtID.Text = reader["cod"].ToString();
                }
                else
                {
                    MessageBox.Show("No se encontraron registros");
                }
            }

            //llenarCombo();

            for (int i = 1; i < bmp.Width; i++)
                for (int j = 1; j < bmp.Height; j++)
                {
                    c = bmp.GetPixel(i, j);
                    cpoa.SetPixel(i, j, c);
                }
            pictureBox2.Image = cpoa;
        }

        private void button4_Click(object sender, EventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap cpoa = new Bitmap(bmp.Width, bmp.Height);
            Color c = new Color();
            for (int i = 1; i < bmp.Width; i++)
                for (int j = 1; j < bmp.Height; j++)
                {
                    c = bmp.GetPixel(i, j);
                    cpoa.SetPixel(i, j, Color.FromArgb(c.R, 0 , 0) );
                }
            pictureBox2.Image = cpoa;
        }

        private void button5_Click(object sender, EventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap cpoa = new Bitmap(bmp.Width, bmp.Height);
            Color c = new Color();
            for (int i = 1; i < bmp.Width; i++)
                for (int j = 1; j < bmp.Height; j++)
                {
                    c = bmp.GetPixel(i, j);
                    cpoa.SetPixel(i, j, Color.FromArgb(0, c.G, 0));
                }
            pictureBox2.Image = cpoa;
        }

        private void button6_Click(object sender, EventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap cpoa = new Bitmap(bmp.Width, bmp.Height);
            Color c = new Color();
            for (int i = 1; i < bmp.Width; i++)
                for (int j = 1; j < bmp.Height; j++)
                {
                    c = bmp.GetPixel(i, j);
                    if (((cR - 10) < c.R) && (c.R < (cR + 10)) && ((cG - 10) < c.G) && (c.G < (cG + 10)) && ((cB - 10) < c.B) && (c.B < (cB + 10)))
                        cpoa.SetPixel(i, j, Color.Black);
                    else 
                        cpoa.SetPixel(i, j, c);
                }
            pictureBox2.Image = cpoa;
        }

        private void button7_Click(object sender, EventArgs e)
        {
            if (txtP.Text == "")
            {
                int meR, meG, meB;
                Bitmap bmp = new Bitmap(pictureBox1.Image);
                Bitmap cpoa = new Bitmap(bmp.Width, bmp.Height);
                Color c = new Color();
                for (int i = 0; i < bmp.Width - 10; i += 10)
                    for (int j = 0; j < bmp.Height - 10; j += 10)
                    {
                        meR = 0;
                        meG = 0;
                        meB = 0;

                        for (int k = i; k < i + 10; k++)
                            for (int l = j; l < j + 10; l++)
                            {
                                c = bmp.GetPixel(k, l);
                                meR = meR + c.R;
                                meG = meG + c.G;
                                meB = meB + c.B;
                            }
                        meR = meR / 100;
                        meG = meG / 100;
                        meB = meB / 100;

                        if (((cR - 10) < meR) && (meR < (cR + 10)) && ((cG - 10) < meG) && (meG < (cG + 10)) && ((cB - 10) < meB) && (meB < (cB + 10)))
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    cpoa.SetPixel(k, l, Color.Black);
                                }

                        else
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    c = bmp.GetPixel(k, l);
                                    cpoa.SetPixel(k, l, c);
                                }
                    }
                pictureBox2.Image = cpoa;
                using (MySqlConnection con = new MySqlConnection())
                {
                    con.ConnectionString = "Server=localhost;UserID=root;Database=texturas;Password=moises123;";
                    con.Open();
                    using (MySqlCommand cmd = new MySqlCommand())
                    {
                        cmd.Connection = con;
                        cmd.CommandText = "update imagen set r1=(@cr),g1=(@cg),b1=(@cb) where cod="+txtID.Text;
                        cmd.Parameters.AddWithValue("@cr", cR);
                        cmd.Parameters.AddWithValue("@cg", cG);
                        cmd.Parameters.AddWithValue("@cb", cB);
                        cmd.ExecuteNonQuery();
                    }
                }
            }
            else
            {
                int meR, meG, meB;
                Bitmap bmp = new Bitmap(pictureBox1.Image);
                Bitmap cpoa = new Bitmap(bmp.Width, bmp.Height);
                Color c = new Color();
                for (int i = 0; i < bmp.Width - 10; i += 10)
                    for (int j = 0; j < bmp.Height - 10; j += 10)
                    {
                        meR = 0;
                        meG = 0;
                        meB = 0;

                        for (int k = i; k < i + 10; k++)
                            for (int l = j; l < j + 10; l++)
                            {
                                c = bmp.GetPixel(k, l);
                                meR = meR + c.R;
                                meG = meG + c.G;
                                meB = meB + c.B;
                            }
                        meR = meR / 100;
                        meG = meG / 100;
                        meB = meB / 100;

                        if (((r1 - 10) < meR) && (meR < (r1 + 10)) && ((g1 - 10) < meG) && (meG < (g1 + 10)) && ((b1 - 10) < meB) && (meB < (b1 + 10)))
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    cpoa.SetPixel(k, l, Color.Black);
                                }

                        else
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    c = bmp.GetPixel(k, l);
                                    cpoa.SetPixel(k, l, c);
                                }
                    }
                pictureBox2.Image = cpoa;
            }

        }

        private void button8_Click(object sender, EventArgs e)
        {
            if (txtP.Text == "")
            {
                int meR, meG, meB;
                Bitmap bmp = new Bitmap(pictureBox1.Image);
                Bitmap cpoa = new Bitmap(bmp.Width, bmp.Height);
                Color c = new Color();
                for (int i = 0; i < bmp.Width - 10; i += 10)
                    for (int j = 0; j < bmp.Height - 10; j += 10)
                    {
                        meR = 0;
                        meG = 0;
                        meB = 0;

                        for (int k = i; k < i + 10; k++)
                            for (int l = j; l < j + 10; l++)
                            {
                                c = bmp.GetPixel(k, l);
                                meR = meR + c.R;
                                meG = meG + c.G;
                                meB = meB + c.B;
                            }
                        meR = meR / 100;
                        meG = meG / 100;
                        meB = meB / 100;

                        if (((cR - 10) < meR) && (meR < (cR + 10)) && ((cG - 10) < meG) && (meG < (cG + 10)) && ((cB - 10) < meB) && (meB < (cB + 10)))
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    cpoa.SetPixel(k, l, Color.Blue);
                                }

                        else
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    c = bmp.GetPixel(k, l);
                                    cpoa.SetPixel(k, l, c);
                                }
                    }
                pictureBox2.Image = cpoa;
                using (MySqlConnection con = new MySqlConnection())
                {
                    con.ConnectionString = "Server=localhost;UserID=root;Database=texturas;Password=moises123;";
                    con.Open();
                    using (MySqlCommand cmd = new MySqlCommand())
                    {
                        cmd.Connection = con;
                        cmd.CommandText = "update imagen set r2=(@cr),g2=(@cg),b2=(@cb) where cod=" + txtID.Text;
                        cmd.Parameters.AddWithValue("@cr", cR);
                        cmd.Parameters.AddWithValue("@cg", cG);
                        cmd.Parameters.AddWithValue("@cb", cB);
                        cmd.ExecuteNonQuery();
                    }
                }
            }
            else
            {
                int meR, meG, meB;
                Bitmap bmp = new Bitmap(pictureBox1.Image);
                Bitmap cpoa = new Bitmap(bmp.Width, bmp.Height);
                Color c = new Color();
                for (int i = 0; i < bmp.Width - 10; i += 10)
                    for (int j = 0; j < bmp.Height - 10; j += 10)
                    {
                        meR = 0;
                        meG = 0;
                        meB = 0;

                        for (int k = i; k < i + 10; k++)
                            for (int l = j; l < j + 10; l++)
                            {
                                c = bmp.GetPixel(k, l);
                                meR = meR + c.R;
                                meG = meG + c.G;
                                meB = meB + c.B;
                            }
                        meR = meR / 100;
                        meG = meG / 100;
                        meB = meB / 100;

                        if (((r2 - 10) < meR) && (meR < (r2 + 10)) && ((g2 - 10) < meG) && (meG < (g2 + 10)) && ((b2 - 10) < meB) && (meB < (b2 + 10)))
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    cpoa.SetPixel(k, l, Color.Blue);
                                }

                        else
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    c = bmp.GetPixel(k, l);
                                    cpoa.SetPixel(k, l, c);
                                }
                    }
                pictureBox2.Image = cpoa;
            }
        }
 
        private void button9_Click(object sender, EventArgs e)
        {
            if (txtP.Text == "")
            {
                int meR, meG, meB;
                Bitmap bmp = new Bitmap(pictureBox1.Image);
                Bitmap cpoa = new Bitmap(bmp.Width, bmp.Height);
                Color c = new Color();
                for (int i = 0; i < bmp.Width - 10; i += 10)
                    for (int j = 0; j < bmp.Height - 10; j += 10)
                    {
                        meR = 0;
                        meG = 0;
                        meB = 0;

                        for (int k = i; k < i + 10; k++)
                            for (int l = j; l < j + 10; l++)
                            {
                                c = bmp.GetPixel(k, l);
                                meR = meR + c.R;
                                meG = meG + c.G;
                                meB = meB + c.B;
                            }
                        meR = meR / 100;
                        meG = meG / 100;
                        meB = meB / 100;

                        if (((cR - 10) < meR) && (meR < (cR + 10)) && ((cG - 10) < meG) && (meG < (cG + 10)) && ((cB - 10) < meB) && (meB < (cB + 10)))
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    cpoa.SetPixel(k, l, Color.DarkRed);
                                }

                        else
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    c = bmp.GetPixel(k, l);
                                    cpoa.SetPixel(k, l, c);
                                }
                    }
                pictureBox2.Image = cpoa;
                using (MySqlConnection con = new MySqlConnection())
                {
                    con.ConnectionString = "Server=localhost;UserID=root;Database=texturas;Password=moises123;";
                    con.Open();
                    using (MySqlCommand cmd = new MySqlCommand())
                    {
                        cmd.Connection = con;
                        cmd.CommandText = "update imagen set r3=(@cr),g3=(@cg),b3=(@cb) where cod=" + txtID.Text;
                        cmd.Parameters.AddWithValue("@cr", cR);
                        cmd.Parameters.AddWithValue("@cg", cG);
                        cmd.Parameters.AddWithValue("@cb", cB);
                        cmd.ExecuteNonQuery();
                    }
                }
            }
            else
            {
                int meR, meG, meB;
                Bitmap bmp = new Bitmap(pictureBox1.Image);
                Bitmap cpoa = new Bitmap(bmp.Width, bmp.Height);
                Color c = new Color();
                for (int i = 0; i < bmp.Width - 10; i += 10)
                    for (int j = 0; j < bmp.Height - 10; j += 10)
                    {
                        meR = 0;
                        meG = 0;
                        meB = 0;

                        for (int k = i; k < i + 10; k++)
                            for (int l = j; l < j + 10; l++)
                            {
                                c = bmp.GetPixel(k, l);
                                meR = meR + c.R;
                                meG = meG + c.G;
                                meB = meB + c.B;
                            }
                        meR = meR / 100;
                        meG = meG / 100;
                        meB = meB / 100;

                        if (((r3 - 10) < meR) && (meR < (r3 + 10)) && ((g3 - 10) < meG) && (meG < (g3 + 10)) && ((b3 - 10) < meB) && (meB < (b3 + 10)))
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    cpoa.SetPixel(k, l, Color.DarkRed);
                                }

                        else
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    c = bmp.GetPixel(k, l);
                                    cpoa.SetPixel(k, l, c);
                                }
                    }
                pictureBox2.Image = cpoa;
            }
        }
        
        private void button2_Click(object sender, EventArgs e)
        {
            llenarCombo();
            limpiar();
            OpenFileDialog ofdSeleccionar = new OpenFileDialog();
            ofdSeleccionar.Filter = "Imagenes|*.jpg; *.png";
            ofdSeleccionar.InitialDirectory = Environment.GetFolderPath(Environment.SpecialFolder.MyPictures);
            ofdSeleccionar.Title = "Seleccionar imagen";

            if (ofdSeleccionar.ShowDialog() == DialogResult.OK)
            {
                pictureBox1.Image = Image.FromFile(ofdSeleccionar.FileName);
            }

            txtID.Text = "";
            txtNombre.Text = "";
            txtP.Text = "";
        }

        private void label4_Click(object sender, EventArgs e)
        {

        }

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {
            limpiar();
            string x = Convert.ToString(comboBox1.SelectedValue);
            txtID.Text = x;
            string sql = "SELECT * FROM imagen WHERE cod=" + x ;
            
            using (MySqlConnection con = new MySqlConnection())
            {
                con.ConnectionString = "Server=localhost;UserID=root;Database=texturas;Password=moises123;";
                con.Open();
                MySqlCommand cmd = new MySqlCommand(sql, con);
                MySqlDataReader reader = cmd.ExecuteReader();

                if (reader.HasRows)
                {
                    reader.Read();
                    MemoryStream ms = new MemoryStream((byte[])reader["img"]);
                    Bitmap bm = new Bitmap(ms);
                    pictureBox1.Image = bm;
                    txtNombre.Text = reader["nombre"].ToString();
                    r1 = Convert.ToInt32(reader["r1"]); g1 = Convert.ToInt32(reader["g1"]); b1 = Convert.ToInt32(reader["b1"]);
                    r2 = Convert.ToInt32(reader["r2"]); g2 = Convert.ToInt32(reader["g2"]); b2 = Convert.ToInt32(reader["b2"]);
                    r3 = Convert.ToInt32(reader["r3"]); g3 = Convert.ToInt32(reader["g3"]); b3 = Convert.ToInt32(reader["b3"]);

                    txtP.Text = Convert.ToString(r1) + Convert.ToString(g1) + Convert.ToString(b1);
                }
                else
                {
                    MessageBox.Show("No se encontraron registros");
                }
            }
        }
        private void llenarCombo()
        {
            MySqlConnection con = new MySqlConnection();
            MySqlDataAdapter ada = new MySqlDataAdapter();
            con.ConnectionString = "Server=localhost;UserID=root;Database=texturas;Password=moises123;";
            ada.SelectCommand = new MySqlCommand();
            ada.SelectCommand.Connection = con;
            ada.SelectCommand.CommandText = "select cod,nombre from imagen";
            //ada.SelectCommand.ExecuteNonQuery();

            DataTable dt = new DataTable();
            ada.Fill(dt);

            comboBox1.ValueMember = "cod";
            comboBox1.DisplayMember = "nombre";
            comboBox1.DataSource = dt;
        }
        private void limpiar()
        {
            pictureBox2.Image = null;
            textBox1.Text = "";
            textBox2.Text = "";
            textBox3.Text = "";
        }
    }
}
