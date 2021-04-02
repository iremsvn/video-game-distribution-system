import java.sql.*;

public class database {
            private static Connection conn;
            private static Statement st;

            public static void connect() {
                try {
                    Class.forName("com.mysql.cj.jdbc.Driver");
                    String url = "jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr:***";

                    String username = "***";
                    String password = "***";
                    conn = DriverManager.getConnection(url, username, password);
                    st = conn.createStatement();
                    System.out.println("Connected!");
                }
                catch (ClassNotFoundException ex) {
                    ex.printStackTrace();
                    System.out.println("MySQL driver is not provided");
                }
                catch (SQLException ex) {
                    ex.printStackTrace();
                    System.out.println("Could not connect to database. Please check your internet connection and/or credentials.");
                }
            }

            public static void main(String[] args) {
                connect();
                try {


                    st.executeUpdate("DROP TABLE IF EXISTS make_mode");
                    st.executeUpdate("DROP TABLE IF EXISTS has_user_mode");
                    st.executeUpdate("DROP TABLE IF EXISTS has_game_mode");
                    st.executeUpdate("DROP TABLE IF EXISTS has_achievement");
                    st.executeUpdate("DROP TABLE IF EXISTS adds");
                    st.executeUpdate("DROP TABLE IF EXISTS asks");
                    st.executeUpdate("DROP TABLE IF EXISTS updates");
                    st.executeUpdate("DROP TABLE IF EXISTS develops");
                    st.executeUpdate("DROP TABLE IF EXISTS publish");
                    st.executeUpdate("DROP TABLE IF EXISTS friendship");
                    st.executeUpdate("DROP TABLE IF EXISTS follows");
                    st.executeUpdate("DROP TABLE IF EXISTS wishlist");
                    st.executeUpdate("DROP TABLE IF EXISTS has_game");
                    st.executeUpdate("DROP TABLE IF EXISTS user_comment");
                    st.executeUpdate("DROP TABLE IF EXISTS curator_comment");
                    st.executeUpdate("DROP TABLE IF EXISTS user_rates");
                    st.executeUpdate("DROP TABLE IF EXISTS curator_rates");
                    st.executeUpdate("DROP TABLE IF EXISTS achievement");
                    st.executeUpdate("DROP TABLE IF EXISTS level");
                    st.executeUpdate("DROP TABLE IF EXISTS mode");
                    st.executeUpdate("DROP TABLE IF EXISTS game");
                    st.executeUpdate("DROP TABLE IF EXISTS admin");
                    st.executeUpdate("DROP TABLE IF EXISTS user");
                    st.executeUpdate("DROP TABLE IF EXISTS curator");
                    st.execute("DROP TABLE IF EXISTS publisher");
                    st.execute("DROP TABLE IF EXISTS developer");
                    st.execute("DROP TABLE IF EXISTS account");


                    //st.executeUpdate("DROP TABLE IF EXISTS returns");
                    //st.executeUpdate("DROP TABLE IF EXISTS preferences");


                    st.execute("CREATE TABLE account (email VARCHAR(30) NOT NULL, username VARCHAR(15) NOT NULL, name VARCHAR(30) NOT NULL, " +
                            "balance INT NOT NULL, surname VARCHAR(20) NOT NULL, password VARCHAR(15) NOT NULL, address VARCHAR(80) NOT NULL, age INT NOT NULL, " +
                            "primary key(email)) ENGINE = InnoDB;");


                    st.execute("CREATE TABLE developer (dev_id INT NOT NULL AUTO_INCREMENT, comp_name VARCHAR(40) NOT NULL, email VARCHAR(30) NOT NULL, " +
                            "FOREIGN KEY(email) references account(email), primary key(dev_id)) ENGINE = InnoDB;");


                    st.execute("CREATE TABLE publisher (pub_id INT NOT NULL AUTO_INCREMENT, pub_name VARCHAR(40) NOT NULL, " +
                            "pub_address VARCHAR(80) NOT NULL, email VARCHAR(30) NOT NULL, " +
                            "foreign key(email) references account(email), primary key (pub_id)) ENGINE = InnoDB;");


                    st.executeUpdate("CREATE TABLE user (user_id INT NOT NULL AUTO_INCREMENT, points INT NOT NULL, num_friends INT NOT NULL," +
                            "email VARCHAR(30) NOT NULL, foreign key(email) references account(email), primary key (user_id)) ENGINE = InnoDB;") ;


                    st.executeUpdate("CREATE TABLE curator (cur_id INT NOT NULL AUTO_INCREMENT, email VARCHAR(30) NOT NULL,  " +
                            "foreign key(email) references account(email), primary key (cur_id)) ENGINE = InnoDB;");

                    st.executeUpdate("CREATE TABLE admin (admin_id INT NOT NULL AUTO_INCREMENT, email VARCHAR(30) NOT NULL,  " +
                            "foreign key(email) references account(email), primary key (admin_id)) ENGINE = InnoDB; ");


                    st.execute("CREATE TABLE game (game_id INT NOT NULL AUTO_INCREMENT, game_name VARCHAR(40) NOT NULL, genre VARCHAR(15)," +
                            "game_version VARCHAR(10), game_release DATE, game_description VARCHAR(300), price INT, requirements VARCHAR(100)," +
                            "primary key (game_id)) ENGINE = InnoDB;");


                    st.execute("CREATE TABLE mode (mod_id INT NOT NULL AUTO_INCREMENT, game_id INT NOT NULL, mod_name VARCHAR(30) NOT NULL, mod_description VARCHAR(200) " +
                            " NOT NULL, primary key (mod_id), foreign key(game_id) references game(game_id)) ENGINE = InnoDB;");

                    st.executeUpdate("CREATE TABLE level (level_num INT NOT NULL, level_reward INT NOT NULL, primary key (level_num), " +
                            "check(level_reward > 0)) ENGINE = InnoDB;");

                    st.executeUpdate("CREATE TABLE achievement (ach_id INT NOT NULL AUTO_INCREMENT, ach_name VARCHAR(40) not null, ach_description VARCHAR(40), " +
                            " ach_reward INT NOT NULL, ach_point INT NOT NULL, primary key (ach_id))" +
                            " ENGINE = InnoDB;");


                    st.executeUpdate("CREATE TABLE user_comment ( u_com_id INT NOT NULL AUTO_INCREMENT,user_id INT NOT NULL, u_review VARCHAR(250) NOT NULL, game_id INT NOT NULL, " +
                            "primary key (u_com_id), foreign key(user_id) references user(user_id)) ENGINE = InnoDB;");

                    st.executeUpdate("CREATE TABLE curator_comment ( u_com_id INT NOT NULL AUTO_INCREMENT,user_id INT NOT NULL, u_review VARCHAR(250) NOT NULL, game_id INT NOT NULL, " +
                            "primary key (u_com_id), foreign key(user_id) references user(user_id)) ENGINE = InnoDB;");


                    st.executeUpdate("CREATE TABLE user_rates (game_id INT NOT NULL, user_id INT NOT NULL, u_rate INT NOT NULL, " +
                            "primary key (game_id, user_id), foreign key(user_id) references user(user_id), foreign key(game_id) references game(game_id)) ENGINE = InnoDB;");


                    st.executeUpdate("CREATE TABLE curator_rates(cur_id INT NOT NULL, game_id INT NOT NULL, c_rate INT NOT NULL, primary key (cur_id, game_id), " +
                            "foreign key(cur_id) references curator(cur_id), foreign key(game_id) references game(game_id)) ENGINE = InnoDB;");


                    st.executeUpdate("Create table has_game (user_id INT NOT NULL, game_id INT NOT NULL, primary key (user_id, game_id), " +
                            "foreign key(user_id) references user(user_id), foreign key(game_id) references game(game_id)) ENGINE = InnoDB;");


                    st.executeUpdate("CREATE TABLE wishlist(user_id INT NOT NULL, game_id INT NOT NULL, primary key (user_id, game_id), foreign key(user_id) references user(user_id), foreign key(game_id) references game(game_id)) ENGINE = InnoDB;");


                    st.executeUpdate("CREATE TABLE follows (user_id INT NOT NULL, cur_id INT NOT NULL, primary key (user_id, cur_id), " +
                            "foreign key(user_id) references user(user_id), foreign key(cur_id) references curator(cur_id)) ENGINE = InnoDB;");


                    st.executeUpdate("CREATE TABLE friendship(user_id  INT NOT NULL, friend_id INT NOT NULL, f_status INT NULL, primary key (user_id, friend_id), " +
                            "foreign key(user_id) references user(user_id), foreign key(friend_id) references user(user_id)) ENGINE = InnoDB;");


                    st.executeUpdate("CREATE TABLE publish(pub_id INT NOT NULL, game_id INT NOT NULL, primary key (pub_id, game_id), " +
                            "foreign key(pub_id) references publisher(pub_id), foreign key(game_id) references game(game_id)) ENGINE = InnoDB;");

                    st.executeUpdate("CREATE TABLE develops (game_id INT NOT NULL, dev_id INT NOT NULL, primary key (game_id), foreign key(dev_id) references developer(dev_id), " +
                            "foreign key(game_id) references game(game_id)) ENGINE = InnoDB;");


                    st.executeUpdate("CREATE TABLE updates (game_id INT NOT NULL, dev_id INT NOT NULL, version VARCHAR(10) NOT NULL, date DATE NOT NULL, primary key (game_id)," +
                            "foreign key(dev_id) references developer(dev_id), foreign key(game_id) references game(game_id)) ENGINE = InnoDB;");


                    st.executeUpdate("CREATE TABLE asks (dev_id INT NOT NULL , pub_id INT NOT NULL , approved INT NOT NULL , primary key (dev_id, pub_id), foreign key(dev_id) " +
                            "references developer(dev_id), foreign key(pub_id) references publisher(pub_id)) ENGINE = InnoDB;");



                    st.executeUpdate("CREATE TABLE adds(admin_id INT NOT NULL, ach_id INT NOT NULL, primary key (admin_id, ach_id), foreign key(admin_id) " +
                            "references admin(admin_id), foreign key(ach_id) references achievement(ach_id)) ENGINE = InnoDB;");


                    st.executeUpdate("CREATE TABLE has_achievement(user_id INT NOT NULL, ach_id INT NOT NULL, level_num INT NOT NULL, primary key (user_id, ach_id)," +
                            " foreign key(user_id) references user(user_id), foreign key(ach_id) references achievement(ach_id), foreign key(level_num) references level(level_num)) ENGINE = InnoDB;");



                    st.executeUpdate("CREATE TABLE make_mode(mod_id INT NOT NULL, user_id INT NOT NULL, primary key (mod_id), foreign key(user_id) references user(user_id), " +
                            "foreign key(mod_id) references mode(mod_id)) ENGINE = InnoDB;");

                    st.executeUpdate("CREATE TABLE has_user_mode(mod_id INT NOT NULL, user_id INT NOT NULL, primary key (mod_id), foreign key(user_id) " +
                            "references user(user_id), foreign key(mod_id) references mode(mod_id)) ENGINE = InnoDB;");

                    st.executeUpdate("CREATE TABLE has_game_mode (mod_id INT NOT NULL, game_id INT NOT NULL, primary key (mod_id), " +
                            "foreign key(game_id) references game(game_id),foreign key(mod_id) references mode(mod_id)) ENGINE = InnoDB;");


                      /*
                    st.executeUpdate("CREATE TABLE preferences(email VARCHAR(30) NOT NULL, preference_id INT NOT NULL AUTO_INCREMENT, preferenceName VARCHAR(30) NOT NULL, " +
                            "value VARCHAR(50) NOT NULL, primary key (email, preference_id), foreign key(email) references account) ENGINE = InnoDB;");

                    st.executeUpdate("CREATE TABLE returns(user_id INT NOT NULL, game_id INT NOT NULL, returnDate DATE NOT NULL, rStatus VARCHAR(20), primary key (user_id, game_id)," +
                            " foreign key(user_id) references user, foreign key(game_id) references game) ENGINE = InnoDB;");
                    */


                    //***some foo initial values to test the database***
                    st.execute("INSERT INTO game (game_name, genre, game_version, game_release, game_description, price, requirements) VALUES" +
                            "('God of War 3', 'Action', '1.0','2017-01-01', 'Kratos is the boss', '0', 'gtx750+, i5+');");

                    st.execute("INSERT INTO game (game_name, genre, game_version, game_release, game_description, price, requirements) VALUES" +
                            "('Silent Hill', 'Horror', '1.0','2015-06-01', 'Have some good game', '0', 'gtx750+, i3+');");


                } catch (SQLException e) {
                    e.printStackTrace();

                }
            }
        }

