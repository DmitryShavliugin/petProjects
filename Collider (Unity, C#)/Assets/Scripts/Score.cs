using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using System;

public class Score : MonoBehaviour
{
    public Transform player;
    public Text scoreText;


    void Update()
    {
        scoreText.text = Convert.ToString(((int)player.position.z + 99)/10);
    }
}
